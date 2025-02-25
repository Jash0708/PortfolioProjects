#!/usr/bin/env python
# coding: utf-8

# In[1]:


import pandas as pd 


# In[2]:


raw_csv_data = pd.read_csv("/Users/jashpandav/Downloads/Absenteeism-data.csv")


# In[3]:


type(raw_csv_data)


# In[4]:


raw_csv_data


# In[5]:


df = raw_csv_data.copy()


# In[6]:


df


# In[7]:


pd.options.display.max_columns = None
pd.options.display.max_rows = None


# In[8]:


display(df)


# In[9]:


df.info()


# <h1> Drop 'ID' <h1>

# In[10]:


df.drop(['ID',], axis = 1)


# In[11]:


df = df.drop(['ID'], axis = 1)


# In[12]:


df


# In[13]:


#df = raw_csv_data.copy()


# In[14]:


#df


# In[15]:


#df


# <h1> 'Reason for Absesnce '<h1> 

# In[16]:


df['Reason for Absence']


# In[17]:


df['Reason for Absence'].min()


# In[18]:


df['Reason for Absence'].max()


# In[19]:


pd.unique(df['Reason for Absence'])


# In[20]:


df['Reason for Absence'].unique()


# In[21]:


len(df['Reason for Absence'].unique())


# In[22]:


sorted(df['Reason for Absence'].unique())


# <h2> .get_dummies() <h2>

# In[23]:


reason_columns = pd.get_dummies(df['Reason for Absence'].astype(int))


# In[24]:


reason_columns


# In[25]:


reason_columns['check'] = reason_columns.sum(axis = 1)


# In[26]:


reason_columns


# In[27]:


reason_columns['check'].sum(axis=0)


# In[28]:


reason_columns['check'].unique()


# In[29]:


reason_columns = reason_columns.drop(['check'], axis = 1)
reason_columns


# In[30]:


reason_columns = pd.get_dummies(df['Reason for Absence'], drop_first = True)


# In[31]:


reason_columns


# <h2> Group the Reasons for Absence <h2>

# In[32]:


df.columns.values


# In[33]:


reason_columns.columns.values


# In[34]:


df = df.drop(['Reason for Absence'], axis = 1)


# In[35]:


df


# In[36]:


reason_columns.loc[:, 1:14].max(axis = 1).astype(int)


# In[37]:


reason_type_1 = reason_columns.loc[:, 1:14].max(axis = 1).astype(int)
reason_type_2 = reason_columns.loc[:, 15:17].max(axis = 1).astype(int)
reason_type_3 = reason_columns.loc[:, 18:21].max(axis = 1).astype(int)
reason_type_4 = reason_columns.loc[:, 22:].max(axis = 1).astype(int)


# In[38]:


reason_type_4


# <h2> Group the Reasons for Absence <h2>  

# In[39]:


df.columns.values


# In[40]:


reason_columns.columns.values


# <h2> Concatenate Column Values <h2>

# In[41]:


df


# In[42]:


df = pd.concat([df, reason_type_1, reason_type_2, reason_type_3, reason_type_4], axis = 1)
df


# In[43]:


df.columns.values


# In[44]:


column_names = ['Date', 'Transportation Expense', 'Distance to Work', 'Age',
       'Daily Work Load Average', 'Body Mass Index', 'Education',
       'Children', 'Pets', 'Absenteeism Time in Hours', 'Reason_1', 'Reason_2', 'Reason_3', 'Reason_4']


# In[45]:


df.columns = column_names


# In[46]:


df.head()


# <h1> Reorder Columns <h1>

# In[47]:


column_names_reordered =['Reason_1', 'Reason_2', 'Reason_3', 'Reason_4', 'Date', 'Transportation Expense', 'Distance to Work', 'Age',
       'Daily Work Load Average', 'Body Mass Index', 'Education', 'Children', 'Pets', 'Absenteeism Time in Hours']


# In[48]:


df = df[column_names_reordered]


# In[49]:


df.head()


# <h1> Create a Checkpoint <h1> 

# In[50]:


df_reason_mod = df.copy()


# In[51]:


df_reason_mod


# <h1> 'Date': <h1>

# In[52]:


type(df_reason_mod['Date'])


# In[53]:


df_reason_mod['Date'] = pd.to_datetime(df_reason_mod['Date'], format = '%d/%m/%Y')


# In[54]:


df_reason_mod['Date']


# In[55]:


type(df_reason_mod['Date'][0])


# In[56]:


df_reason_mod.info()


# In[57]:


df_reason_mod['Date'][0]    


# In[58]:


df_reason_mod['Date'][0].month


# In[59]:


list_months = []
list_months


# In[60]:


df_reason_mod.shape


# In[61]:


for i in range(df_reason_mod.shape[0]):
    list_months.append(df_reason_mod['Date'][i].month)


# In[62]:


list_months


# In[63]:


len(list_months)


# In[64]:


df_reason_mod['Month Value'] = list_months


# In[65]:


df_reason_mod.head(20)


# <h1> Extract the Day of the Week:<h1> 

# In[66]:


df_reason_mod['Date'][699].weekday()


# In[67]:


df_reason_mod['Date'][699]


# In[68]:


def date_to_weekday(date_value):
    return date_value.weekday()


# In[69]:


df_reason_mod['Day of the Week'] = df_reason_mod['Date'].apply(date_to_weekday)


# In[70]:


df_reason_mod.head()


# In[71]:


df_reason_date_mod = df_reason_mod.copy()
df_reason_date_mod


# In[74]:


type(df_reason_date_mod['Transportation Expense'][0])


# In[75]:


type(df_reason_date_mod['Distance to Work'][0])


# In[77]:


type(df_reason_date_mod['Age'][0])


# In[78]:


type(df_reason_date_mod['Daily Work Load Average'][0])


# In[79]:


type(df_reason_date_mod['Body Mass Index'][0])


# <h1> 'Education', 'Children', 'Pets'<h1>

# In[80]:


display(df_reason_date_mod)


# In[81]:


df_reason_date_mod['Education'].unique()


# In[82]:


df_reason_date_mod['Education'].value_counts()


# In[86]:


df_reason_date_mod['Education'] = df_reason_date_mod['Education'].map({1:0, 2:1, 3:1, 4:1})


# In[87]:


df_reason_date_mod['Education'].unique()


# In[88]:


df_reason_date_mod['Education'].value_counts()


# In[89]:


df_cleaned = df_reason_date_mod.copy()
df_cleaned.head(10)


# In[ ]:




