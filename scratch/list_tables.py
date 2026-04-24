import sqlite3
import json

conn = sqlite3.connect('c:\\windowc\\htdocs\\news\\Scalable-News-Application\\app\\database.sqlite')
cursor = conn.cursor()
cursor.execute("SELECT name FROM sqlite_master WHERE type='table'")
tables = cursor.fetchall()
print("Tables:", tables)

for table in tables:
    table_name = table[0]
    print(f"\nSchema for {table_name}:")
    cursor.execute(f"PRAGMA table_info({table_name})")
    print(cursor.fetchall())
    
    print(f"\nData in {table_name}:")
    cursor.execute(f"SELECT * FROM {table_name} LIMIT 20")
    rows = cursor.fetchall()
    for row in rows:
        print(row)
