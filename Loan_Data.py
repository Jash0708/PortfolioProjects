#!/usr/bin/env python
# coding: utf-8

# <h1>Importing Packages<h1>

# In[1]:


import numpy as np 


# In[2]:


np.set_printoptions(suppress = True, linewidth = 100, precision = 2)


# <h1> Importing Data <h1>

# In[3]:


#raw_data_np = np.genfromtxt("/Users/jashpandav/Downloads/loan-data.csv", delimiter = ';', skip_header = 1, autostrip = True)
#raw_data_np


# In[4]:


with open("/Users/jashpandav/Downloads/loan-data.csv", 'r', encoding='ISO-8859-1') as file:
    raw_data_np = np.genfromtxt(file, delimiter=';', skip_header=1, autostrip=True) #AI

raw_data_np


# <h1> Checking for Incomplete Data <h1>

# In[5]:


np.isnan(raw_data_np).sum()


# In[6]:


temporary_fill = np.nanmax(raw_data_np) + 1
temporary_mean = np.nanmean(raw_data_np, axis = 0)


# In[7]:


temporary_mean


# In[8]:


temporary_stats = np.array([np.nanmin(raw_data_np, axis = 0), temporary_mean, np.max(raw_data_np, axis = 0)])


# In[9]:


temporary_stats


# <h1> Splitting the Dataset <h1>

# <h2> Splitting Columns <h2>

# In[10]:


column_strings = np.argwhere(np.isnan(temporary_mean)).squeeze()
column_strings


# In[11]:


column_numeric = np.argwhere(np.isnan(temporary_mean) == False).squeeze()
column_numeric


# In[12]:


with open("/Users/jashpandav/Downloads/loan-data.csv", 'r', encoding='ISO-8859-1') as file:
    loan_data_strings = np.genfromtxt(file, delimiter=';', 
                                skip_header=1, 
                                autostrip=True,
                               usecols = column_strings,
                                 dtype = str) #AI

loan_data_strings


# In[13]:


with open("/Users/jashpandav/Downloads/loan-data.csv", 'r', encoding='ISO-8859-1') as file:
    loan_data_numeric = np.genfromtxt(file, delimiter=';', 
                                skip_header=1, 
                                autostrip=True,
                               usecols = column_numeric,
                                 filling_values = temporary_fill) #AI

loan_data_numeric


# <h2> The Names of the Column <h2>

# In[14]:


with open("/Users/jashpandav/Downloads/loan-data.csv", 'r', encoding='ISO-8859-1') as file:
    header_full = np.genfromtxt(file, delimiter=';',  
                                autostrip=True,
                                skip_footer = raw_data_np.shape[0],
                                dtype = str)

header_full


# In[15]:


header_strings, header_numeric = header_full[column_strings], header_full[column_numeric]


# In[16]:


header_strings


# In[17]:


header_numeric


# <h1> Creating Checkpoints <h1>

# In[18]:


def checkpoint(file_name, checkpoint_header, checkpoint_data):
    np.savez(file_name, header = checkpoint_header, data = checkpoint_data)
    checkpoint_variable = np.load(file_name + ".npz")
    return(checkpoint_variable)


# In[19]:


checkpoint_test = checkpoint("checkpoint-test", header_strings, loan_data_strings)


# In[20]:


np.array_equal(checkpoint_test['data'], loan_data_strings)


# <h1> Manipulating String Columns<h1>

# In[21]:


header_strings


# In[22]:


header_strings[1] = "issue_date"


# In[23]:


loan_data_strings


# <h2> Issue Date <h2>

# In[24]:


np.unique(loan_data_strings[:,0])


# In[25]:


loan_data_strings[:,0] = np.chararray.strip(loan_data_strings[:,0], "-15")


# In[26]:


np.unique(loan_data_strings[:,0])


# In[27]:


months = np.array(['', 'Jan', 'Feb', 'Mar','Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])


# In[28]:


for i in range(13):
    loan_data_strings[:,0] = np.where(loan_data_strings[:,0] == months[i],
                                     i,
                                     loan_data_strings[:,0])


# In[29]:


np.unique(loan_data_strings[:,0])


# <h2> Loan Status <h2>

# In[30]:


header_strings


# In[31]:


loan_data_strings[:,1]


# In[32]:


np.unique(loan_data_strings[:,1]).size


# In[33]:


status_bad = np.array(['', 'charged off', 'Default', 'Late (31-120 days)'])


# In[34]:


loan_data_strings[:,1] = np.where(np.isin(loan_data_strings[:,1], status_bad),0,1)


# In[35]:


np.unique(loan_data_strings[:,1])


# <h2> Term <h2>

# In[36]:


header_strings


# In[37]:


np.unique(loan_data_strings[:,2])


# In[38]:


loan_data_strings[:,2] = np.chararray.strip(loan_data_strings[:,2], " months")
loan_data_strings[:,2]


# In[39]:


header_strings[2] = "term_months"


# In[40]:


loan_data_strings[:,2] = np.where(loan_data_strings[:,2] == '',
                                 '60',
                                 loan_data_strings[:,2])
loan_data_strings[:,2]


# In[41]:


np.unique(loan_data_strings[:,2])


# <h2> Grade and Subgrade <h2>

# In[42]:


header_strings


# In[43]:


np.unique(loan_data_strings[:,3])


# In[44]:


np.unique(loan_data_strings[:,4])


# <h2> Filling Sub Grade <h2>

# In[45]:


for i in np.unique(loan_data_strings[:,3])[1:]:
    loan_data_strings[:,4] = np.where((loan_data_strings[:,4] == '') & (loan_data_strings[:,3] == i),
    i + '5',
    loan_data_strings[:,4])


# In[46]:


np.unique(loan_data_strings[:,4], return_counts = True)


# In[47]:


loan_data_strings[:,4] = np.where(loan_data_strings[:,4] == '',
                                 'H1',
                                 loan_data_strings[:,4])


# In[48]:


np.unique(loan_data_strings[:,4])


# <h2> Removing Grade <h2>

# In[49]:


loan_data_strings = np.delete(loan_data_strings, 3, axis = 1)


# In[50]:


loan_data_strings[:,3]


# In[51]:


header_strings = np.delete(header_strings, 3)


# In[52]:


header_strings[3]


# <h2> Converting Sub Grade <h2>

# In[53]:


np.unique(loan_data_strings[:,3])


# In[54]:


keys = list(np.unique(loan_data_strings[:,3]))
values = list(range(1, np.unique(loan_data_strings[:,3]).shape[0] + 1))
dict_sub_grade = dict(zip(keys, values))


# In[55]:


dict_sub_grade


# In[56]:


for i in np.unique(loan_data_strings[:,3]):
                  loan_data_strings[:,3] = np.where(loan_data_strings[:,3] == i,
                                                   dict_sub_grade[i],
                                                   loan_data_strings[:,3]) 


# In[57]:


np.unique(loan_data_strings[:,3])


# <h2> Verification Status <h2>

# In[58]:


header_strings


# In[59]:


np.unique(loan_data_strings[:,4])


# In[60]:


loan_data_strings[:,4] = np.where((loan_data_strings[:,4] == '') | (loan_data_strings[:,4] == 'Not Verified'), 0,1)


# In[61]:


np.unique(loan_data_strings[:,4])


# <h2> URL <h2>

# In[62]:


loan_data_strings[:,5]


# In[63]:


np.chararray.strip(loan_data_strings[:,5], "https://www.lendingclub.com/browse/loanDetail.action?loan_id=")


# In[64]:


loan_data_strings[:,5] = np.chararray.strip(loan_data_strings[:,5], "https://www.lendingclub.com/browse/loanDetail.action?loan_id=")


# In[65]:


header_full


# In[66]:


loan_data_numeric[:,0].astype(dtype = np.int32)


# In[67]:


loan_data_strings[:,5].astype(dtype = np.int32)


# In[68]:


np.array_equal(loan_data_numeric[:,0].astype(dtype = np.int32), loan_data_strings[:,5].astype(dtype = np.int32))


# In[69]:


loan_data_strings = np.delete(loan_data_strings, 5, axis = 1)
header_strings = np.delete(header_strings, 5)


# In[70]:


loan_data_strings[:,5]


# In[71]:


header_strings


# In[72]:


loan_data_numeric[:,0]


# In[73]:


header_numeric


# <h2> State Address <h2>

# In[74]:


header_strings


# In[75]:


header_strings[5] = "state_address"


# In[76]:


states_names, states_count = np.unique(loan_data_strings[:,5], return_counts = True)
states_count_sorted = np.argsort(-states_count)
states_names[states_count_sorted], states_count[states_count_sorted]


# In[77]:


loan_data_strings[:,5] = np.where(loan_data_strings[:,5] == '', 0,
                                 loan_data_strings[:,5])


# In[78]:


states_west = np.array(['WA', 'OR', 'CA', 'NV', 'ID',  'MT', 'WY', 'UT', 'CO', 'AZ', 'NM', 'HI', 'AK'])
states_south = np.array(['TX', 'OK', 'AR', 'LA', 'MS', 'AL', 'TN', 'KY', 'FL', 'GA', 'SC', 'NC', 'VA', 'WV', 'MD', 'DE', 'DC'])
states_midwest = np.array(['ND', 'SD', 'NE', 'KS', 'MN', 'IA', 'MO', 'WI', 'IL', 'IN', 'MI', 'OH'])
states_east = np.array(['PA', 'NY', 'NJ', 'CT', 'MA', 'VT', 'NH', 'ME', 'RI'])


# In[79]:


loan_data_strings[:,5] = np.where(np.isin(loan_data_strings[:,5], states_west), 1, loan_data_strings[:,5])
loan_data_strings[:,5] = np.where(np.isin(loan_data_strings[:,5], states_south), 2, loan_data_strings[:,5])
loan_data_strings[:,5] = np.where(np.isin(loan_data_strings[:,5], states_midwest), 3, loan_data_strings[:,5])
loan_data_strings[:,5] = np.where(np.isin(loan_data_strings[:,5], states_east), 4, loan_data_strings[:,5])                          


# In[80]:


np.unique(loan_data_strings[:,5])


# <h1> Converting to Numbers <h1>

# In[81]:


loan_data_strings


# In[82]:


loan_data_strings = loan_data_strings.astype(int)


# In[83]:


loan_data_strings


# <h2> Checkpoint  1: Strings <h2>

# In[84]:


checkpoint_strings = checkpoint("Checkpoint-Strings", header_strings, loan_data_strings)


# In[85]:


checkpoint_strings["header"]


# In[86]:


checkpoint_strings["data"]


# In[87]:


np.array_equal(checkpoint_strings['data'], loan_data_strings)


# <h1> Manipulating Numeric Columns <h1>

# In[88]:


loan_data_numeric 


# In[89]:


np.isnan(loan_data_numeric).sum()


# <h2> Substitute "Filler" Values <h2>

# In[90]:


header_numeric 


# <h2> ID <h2>

# In[91]:


temporary_fill 


# In[92]:


np.isin(loan_data_numeric[:,0], temporary_fill)


# In[93]:


np.isin(loan_data_numeric[:,0], temporary_fill).sum()


# In[94]:


header_numeric


# <h2> Temporary State <h2>

# In[97]:


temporary_stats[:, column_numeric]


# <h2> Funded Amount <h2>

# In[98]:


loan_data_numeric[:,2]


# In[100]:


loan_data_numeric[:,2] = np.where(loan_data_numeric[:,2] == temporary_fill,
                                 temporary_stats[0, column_numeric[2]],
                                 loan_data_numeric[:,2])
loan_data_numeric[:,2]


# In[101]:


temporary_stats[0,3]


# In[102]:


temporary_stats[0,column_numeric[3]]


# <h2> Loaned Amount, Interest Rate, Total Payment, Installment <h2>

# In[103]:


header_numeric 


# In[104]:


for i in [1,2,3,4,5]:
    loan_data_numeric[:,i] = np.where(loan_data_numeric[:,i] == temporary_fill,
                                     temporary_stats[0, column_numeric[i]],
                                     loan_data_numeric[:,i])


# In[105]:


loan_data_numeric


# In[138]:


EUR_USD = np.genfromtxt("/Users/jashpandav/Downloads/EUR-USD.csv", delimiter = ',', autostrip = True, skip_header = 1, usecols = 3)
EUR_USD



# In[139]:


loan_data_strings[:,0]


# In[141]:


exchange_rate = loan_data_strings[:,0]

for i in range(1,13):
    exchange_rate = np.where(exchange_rate == i,
                            EUR_USD[i-1],
                            exchange_rate)
    
exchange_rate = np.where(exchange_rate == 0,
                            np.mean(EUR_USD),
                            exchange_rate)
exchange_rate


# In[142]:


exchange_rate.shape 


# In[143]:


loan_data_numeric.shape 


# In[144]:


exchange_rate = np.reshape(exchange_rate, (10000, 1))


# In[146]:


loan_data_numeric = np.hstack((loan_data_numeric, exchange_rate))


# In[148]:


header_numeric = np.concatenate((header_numeric, np.array(['exchange_rate'])))
header_numeric 


# <h2> From USD to EUR <h2>

# In[151]:


header_numeric


# In[152]:


columns_dollar = np.array([1,2,4,5])


# In[153]:


loan_data_numeric[:,6]


# In[161]:


for i in columns_dollar:
    loan_data_numeric = np.hstack((loan_data_numeric, np.reshape(loan_data_numeric[:, i ] / loan_data_numeric[:,6], (10000,1))))


# In[162]:


loan_data_numeric


# <h2> Expanding the header <h2>

# In[163]:


header_additional = np.array([column_name + '_EUR' for column_name in header_numeric[columns_dollar]])


# In[164]:


header_additional 


# In[166]:


header_numeric = np.concatenate((header_numeric, header_additional))


# In[167]:


header_numeric


# In[168]:


header_numeric[columns_dollar] = np.array([column_name + 'USD' for column_name in header_numeric[columns_dollar]])


# In[169]:


header_numeric 


# In[174]:


columns_index_order = [0,1,7,2,8,3,4,9,5,10,6]


# In[175]:


header_numeric = header_numeric[columns_index_order]


# In[176]:


loan_data_numeric


# In[177]:


loan_data_numeric[:,columns_index_order]


# In[178]:


loan_data_numeric = loan_data_numeric[:, columns_index_order]


# <h2> Interest Rate <h2>

# In[179]:


header_numeric


# In[180]:


loan_data_numeric[:,5]


# In[181]:


loan_data_numeric[:,5] = loan_data_numeric[:,5]/100


# In[182]:


loan_data_numeric[:,5]


# <h2> Checkpoint 2: Numeric <h2>

# In[183]:


checkpoint_numeric = checkpoint("Checkpoint-Numeric", header_numeric, loan_data_numeric)


# In[184]:


checkpoint_numeric['header'], checkpoint_numeric['data']


# <h2> Creating the "Complete" Dataset <h2>

# In[185]:


checkpoint_strings['data'].shape


# In[186]:


checkpoint_numeric['data'].shape


# In[187]:


loan_data = np.hstack((checkpoint_numeric['data'], checkpoint_strings['data']))


# In[188]:


loan_data


# In[189]:


np.isnan(loan_data).sum()


# In[203]:


header_full = np.concatenate((checkpoint_numeric['header'], checkpoint_strings['header']))


# <h2> Sorting the New Dataset <h2> 

# In[191]:


loan_data = loan_data[np.argsort(loan_data[:,0])]


# In[192]:


loan_data


# In[193]:


np.argsort(loan_data[:,0])


# <h2> Storing the New Dataset <h2>

# In[205]:


loan_data = np.vstack((header_full, loan_data))


# In[207]:


np.savetxt("loan-data-preprocessed.csv", loan_data, fmt = "%s", delimiter = ',')


# In[ ]:




