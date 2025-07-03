import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.naive_bayes import GaussianNB
from sklearn.metrics import classification_report, confusion_matrix, accuracy_score
import pymysql
import seaborn as sns
import matplotlib.pyplot as plt
import joblib

# Koneksi ke database
db = pymysql.connect(host="localhost", user="root", password="", database="riskobesity")

# Ambil data dari tabel (PASTIKAN nama kolom lowercase semua di tabel)
query = "SELECT age, gender, height, weight, bmi, label FROM obesity_classification"
data = pd.read_sql(query, db)

# Tampilkan unique Label sebelum dibersihkan
print("=== Sebelum dibersihkan ===")
print(data['label'].unique())

# Bersihkan karakter \r, \n, spasi di Label
data['label'] = data['label'].str.strip()

# Tampilkan unique Label setelah dibersihkan
print("\n=== Setelah dibersihkan ===")
print(data['label'].unique())

# Encode Gender ke numerik
data['gender'] = data['gender'].map({'Male': 0, 'Female': 1})

# Pisahkan fitur dan target
X = data[['age', 'gender', 'height', 'weight', 'bmi']]
y = data['label']

# Split data latih dan uji (80% latih, 20% uji)
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Buat model Naive Bayes
model = GaussianNB()

# Latih model
model.fit(X_train, y_train)

# Prediksi data uji
y_pred = model.predict(X_test)

# Tampilkan classification report
print("\n=== Classification Report ===")
print(classification_report(y_test, y_pred))

# Tampilkan confusion matrix
print("=== Confusion Matrix ===")
cm = confusion_matrix(y_test, y_pred)
print(cm)

# Visualisasi confusion matrix
plt.figure(figsize=(8, 6))
sns.heatmap(cm, annot=True, fmt='d', cmap='Blues', xticklabels=model.classes_, yticklabels=model.classes_)
plt.xlabel('Predicted')
plt.ylabel('Actual')
plt.title('Confusion Matrix')
plt.show()

# Tampilkan akurasi
accuracy = accuracy_score(y_test, y_pred)
print("\n=== Akurasi ===")
print(accuracy)

# Simpan model ke file .pkl
joblib.dump(model, 'model_naive_bayes.pkl')
print("\nModel berhasil disimpan ke model_naive_bayes.pkl")

from sklearn.metrics import classification_report
import pandas as pd

report = classification_report(y_test, y_pred, output_dict=True)
report_df = pd.DataFrame(report).transpose()
report_df.to_csv('assets/classification_report.csv')
