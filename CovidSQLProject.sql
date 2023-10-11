Select *
From PortfolioProject..CovidDeaths
order by 3,4

--Select * 
--From PortfolioProject..CovidVacccinations
--order by 3,4

Select location, date, total_cases, new_cases, total_deaths, population
From PortfolioProject..CovidDeaths
order by 1,2

-- Looking at Total Cases vs Total Deaths


--Select location, date, total_cases, total_deaths, (total_deaths/total_cases) as DeathPercentage 
--From PortfolioProject..CovidDeaths
--order by 1,2

Select location, date, total_cases,total_deaths, 
(CONVERT(float, total_deaths) / NULLIF(CONVERT(float, total_cases), 0)) * 100 AS PercentPopulationInfected
from PortfolioProject..covidDeaths
where location like '%india'
order by 1,2

-- Looking at Total Cases vs Population 


Select location, date, total_cases,population, 
(CONVERT(float, total_cases) / NULLIF(CONVERT(float, population), 0)) * 100 AS Deathpercentage
from PortfolioProject..covidDeaths
where location like '%states%'
order by 1,2

-- Looking at Countries with Highest Infection Rate compated to Population

Select location, MAX(total_cases) as HighestInfectionCount,population, 
MAX((total_cases/population))*100 as PercentPopulationInfected 
from PortfolioProject..covidDeaths
-- where location like '%states%'
Group by Location, Population
order by PercentPopulationInfected desc 


-- Showing Countries with Highest Death Count per Population 



Select location, MAX(cast(total_deaths as int)) as TotalDeathCount
From PortfolioProject..CovidDeaths

-- where location like '%states%'
Where continent is not null
Group by Location
order by TotalDeathCount desc 

-- Continent 

Select continent, MAX(cast(total_deaths as int)) as TotalDeathCount
From PortfolioProject..CovidDeaths

-- where location like '%states%'
Where continent is not null
Group by continent
order by TotalDeathCount desc 

-- Showing continents with highest death count per population 

Select continent, MAX(cast(total_deaths as int)) as TotalDeathCount
From PortfolioProject..CovidDeaths

-- where location like '%states%'
Where continent is not null
Group by continent
order by TotalDeathCount desc 


-- GLOBAL NUMBERS 

Select   SUM(new_cases) as total_cases, SUM(cast(new_deaths as int)) as total_deaths, SUM(cast (new_deaths as int)
)/ nullif(SUM(New_Cases),0)*100 as DeathPercentage 

from PortfolioProject..covidDeaths
where continent is not null 
-- Group by date 
order by 1,2

-- Looking at Total Population vs Vaccinations 

With PopvsVac (Continent, Location, Date, Population, new_vaccinations, RollingPeoplVaccinated)
as 

(
Select dea.continent, dea.location, dea.date, dea.population, vac.new_vaccinations 
, SUM(CONVERT(bigint, vac.new_vaccinations)) OVER (Partition by dea.Location Order by dea.location, dea.Date) as 
RollingPeoplVaccinated
From PortfolioProject..CovidDeaths dea 
Join PortfolioProject..CovidVacccinations vac 
	On dea.location = vac.location
	and dea.date = vac.date 
where dea.continent is not null 
-- order by 1,2,3 
-- USE CTE
)

Select *, (RollingPeoplVaccinated/Population)*100
From PopvsVac

-- TEMP TABLE 

-- Drop Table if exists #PercentPopulationVaccinated 
Create Table #PercentPopulationVaccinated
(
Continent nvarchar(255),
Location nvarchar(255),
Date datetime,
Population numeric,
New_vaccinations numeric,
RollingPeoplVaccinated numeric
)

Insert into #PercentPopulationVaccinated
Select dea.continent, dea.location, dea.date, dea.population, vac.new_vaccinations 
, SUM(CONVERT(bigint, vac.new_vaccinations)) OVER (Partition by dea.Location Order by dea.location, dea.Date) as 
RollingPeoplVaccinated
From PortfolioProject..CovidDeaths dea 
Join PortfolioProject..CovidVacccinations vac 
	On dea.location = vac.location
	and dea.date = vac.date 
where dea.continent is not null 
-- order by 1,2,3 



Select *, (RollingPeoplVaccinated/Population)*100
From #PercentPopulationVaccinated 

-- Creating View to store data for later visualizations 

Use PortfolioProject
Go
Create View PercentPopulationVaccinated as 
Select dea.continent, dea.location, dea.date, dea.population, vac.new_vaccinations 
, SUM(CONVERT(bigint, vac.new_vaccinations)) OVER (Partition by dea.Location Order by dea.location, dea.Date) as 
RollingPeoplVaccinated
From PortfolioProject..CovidDeaths dea 
Join PortfolioProject..CovidVacccinations vac 
	On dea.location = vac.location
	and dea.date = vac.date 
where dea.continent is not null 
 --order by 1,2,3 











