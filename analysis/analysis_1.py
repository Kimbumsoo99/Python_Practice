import pandas as pd
import matplotlib.pyplot as plt
import numpy as np
# import statsmodels.api as sm
# from sklearn import linear_model

csv = pd.read_csv('imu.csv')
# csv.drop(['Index'],axis=1,inplace=True)

csv1 = pd.read_csv('imu2.csv')

standing = csv.loc[(csv['motion'] == 'standing')]
acc_standing_0 = standing['acce_data_0']
acc_standing_1 = standing['acce_data_1']
acc_standing_2 = standing['acce_data_2']

sitting = csv.loc[(csv['motion'] == 'sitting')]
acc_sitting_0 = sitting['acce_data_0']
acc_sitting_1 = sitting['acce_data_1']
acc_sitting_2 = sitting['acce_data_2']

bending = csv.loc[(csv['motion'] == 'bending')]
acc_bending_0 = bending['acce_data_0']
acc_bending_1 = bending['acce_data_1']
acc_bending_2 = bending['acce_data_2']


# collapse = csv1.loc[(csv['motion'] == 'collapse')]
acc_collapse_0 = csv1['acce_data_0']
acc_collapse_1 = csv1['acce_data_1']
acc_collapse_2 = csv1['acce_data_2']

std1 = np.std(acc_standing_2)
std2 = np.std(acc_sitting_2)
std3 = np.std(acc_bending_2)

print(std1)
print(std2)
print(std3)

plt.subplot(221)
plt.plot(acc_standing_2)
plt.title('standing')
plt.show()

plt.subplot(222)
plt.plot(acc_sitting_2)
plt.title('sitting')
plt.show()

plt.subplot(223)
plt.plot(acc_bending_2)
plt.title('bending')
plt.show()

plt.subplot(224)
plt.plot(acc_collapse_2)
plt.title('collapse')
plt.show()
