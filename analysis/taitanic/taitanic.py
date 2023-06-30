import pandas as pd
import matplotlib.pyplot as plt
import seaborn as sns

train = pd.read_csv("train.csv")
test = pd.read_csv("test.csv")

# 데이터 정보
print(train.info())
print(test.info())
print()

# 결즉치
print(train.isnull().sum())
print(test.isnull().sum())
print()

# 생존자
print(train["Survived"].value_counts())

sns.barplot(x="Sex", y="Survived", data=train)

sns.barplot(x="Pclass", y="Survived", data=train)

plt.show()
