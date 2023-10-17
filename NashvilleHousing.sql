-- Cleaning Data in Sql query 

Select  *
From PortfolioProject.dbo.[NashvilleHousing ]

-- Stndardize Date Format 

Select  SaleDateConverted, Convert(Date,SaleDate)
From PortfolioProject.dbo.[NashvilleHousing ]

Update PortfolioProject.dbo.[NashvilleHousing ]
Set SaleDate = CONVERT(Date, SaleDate)

ALTER TABLE PortfolioProject.dbo.[NashvilleHousing ]
Add SaleDateConverted Date;

Update PortfolioProject.dbo.[NashvilleHousing ]
Set SaleDateConverted = CONVERT(Date, SaleDate)

-- Populate Property Address data 

Select *
From PortfolioProject.dbo.[NashvilleHousing ]
-- Where PropertyAddress is null 
order by ParcelID

Select a.ParcelID, a.PropertyAddress, b.ParcelID, b.PropertyAddress, ISNULL(a.PropertyAddress,b.PropertyAddress)
From PortfolioProject.dbo.[NashvilleHousing ] a 
JOIN PortfolioProject.dbo.[NashvilleHousing ] b
	on a.ParcelID = b.ParcelID
	AND a.[UniqueID ] <> b.[UniqueID ]
Where a.PropertyAddress is null 

Update a 
SET PropertyAddress = ISNULL(a.PropertyAddress, b.PropertyAddress)
From PortfolioProject.dbo.[NashvilleHousing ] a 
JOIN PortfolioProject.dbo.[NashvilleHousing ] b
	on a.ParcelID = b.ParcelID
	AND a.[UniqueID ] <> b.[UniqueID ]
Where a.PropertyAddress is null 

-- Breaking out Address into Individual Columns (Address, City, State)

Select PropertyAddress
From PortfolioProject.dbo.[NashvilleHousing ]
-- Where PropertyAddress is null 
-- order by ParcelID

Select 
SUBSTRING(PropertyAddress, 1, CHARINDEX(',', PropertyAddress) -1) as Address
, SUBSTRING(PropertyAddress, CHARINDEX(',',PropertyAddress) + 1,LEN(PropertyAddress)) as Address

From PortfolioProject.dbo.[NashvilleHousing ]




ALTER TABLE PortfolioProject.dbo.[NashvilleHousing ]
Add PropertySplitAddress Nvarchar(255);

Update PortfolioProject.dbo.[NashvilleHousing ]
Set PropertySplitAddress = SUBSTRING(PropertyAddress, 1, CHARINDEX(',', PropertyAddress) -1) 

ALTER TABLE PortfolioProject.dbo.[NashvilleHousing ]
Add PropertySplitCity Nvarchar(255);

Update PortfolioProject.dbo.[NashvilleHousing ]
Set PropertySplitCIty = SUBSTRING(PropertyAddress, CHARINDEX(',', PropertyAddress) +1 , LEN(PropertyAddress))


Select * 
From PortfolioProject.dbo.[NashvilleHousing ]

Select OwnerAddress
From PortfolioProject.dbo.[NashvilleHousing ]

Select 
PARSENAME(REPLACE(OwnerAddress, ',', '.'), 3)
,PARSENAME(REPLACE(OwnerAddress, ',', '.'), 2)
, PARSENAME(REPLACE(OwnerAddress, ',', '.'), 1)
From PortfolioProject.dbo.[NashvilleHousing ]




ALTER TABLE PortfolioProject.dbo.[NashvilleHousing ]
Add OwnerSplitAddress Nvarchar(255);

Update PortfolioProject.dbo.[NashvilleHousing ]
Set OwnerSplitAddress = PARSENAME(REPLACE(OwnerAddress, ',', '.'), 3) 

ALTER TABLE PortfolioProject.dbo.[NashvilleHousing ]
Add OwnerSplitCity Nvarchar(255);

Update PortfolioProject.dbo.[NashvilleHousing ]
Set OwnerSplitCIty = PARSENAME(REPLACE(OwnerAddress, ',', '.'), 2)


ALTER TABLE PortfolioProject.dbo.[NashvilleHousing ]
Add OwnerSplitState Nvarchar(255);

Update PortfolioProject.dbo.[NashvilleHousing ]
Set OwnerSplitState = PARSENAME(REPLACE(OwnerAddress, ',', '.'), 1)

Select *
From PortfolioProject.dbo.[NashvilleHousing ]

-- Change Y and N to Yes and No in "Sold as Vacant" field 

Select Distinct(SoldAsVacant), Count(SoldAsVacant)
From PortfolioProject.dbo.[NashvilleHousing ]
Group by SoldAsVacant
order by 2

Select SoldAsVacant
, CASE When SoldAsVacant = 'Y' THEN 'Yes'
		When SoldAsVacant = 'N' THEN 'No'
		ELSE SoldAsVacant
		End 
From PortfolioProject.dbo.[NashvilleHousing ]

Update PortfolioProject.dbo.[NashvilleHousing ]
SET SoldAsVacant = CASE When SoldAsVacant = 'Y' THEN 'YES'
		When SoldAsVacant = 'N' THEN 'No'
		ELSE SoldAsVacant
		END

-- Remove Duplicates 

WITH RowNumCTE AS(
Select *,
	ROW_NUMBER() OVER (
	PARTITION BY ParcelID,
				 PropertyAddress,
				 SalePrice,
				 SaleDate,
				 LegalReference
				 ORDER BY 
					UniqueID
					)row_num 

From PortfolioProject.dbo.[NashvilleHousing ]
)
Select *
From RowNumCTE
Where row_num > 1
-- Order by PropertyAddress 

Select *
From PortfolioProject.dbo.[NashvilleHousing ]


-- Delete Unused Columns 


Select * 
From PortfolioProject.dbo.[NashvilleHousing ]

Alter TABLE PortfolioProject.dbo.[NashvilleHousing ]
DROP COLUMN OwnerAddress, TaxDistrict, PropertyAddress


Alter TABLE PortfolioProject.dbo.[NashvilleHousing ]
DROP COLUMN SaleDate 
