import pandas as pd
from sqlalchemy import create_engine

# MySQL database connection settings
mysql_config = {
    'host': 'localhost',  # Replace with your MySQL host
    'user': 'username',   # Replace with your MySQL username
    'password': 'password',  # Replace with your MySQL password
    'database': 'your_database',  # Replace with your MySQL database name
}

# Data warehouse settings
output_csv_file = 'data_warehouse.csv'

# Create a MySQL database connection
mysql_url = f"mysql+pymysql://{mysql_config['user']}:{mysql_config['password']}@{mysql_config['host']}/{mysql_config['database']}"
engine = create_engine(mysql_url)

# Establish a database connection
connection = engine.connect()

# Extract data from MySQL and load it into a pandas DataFrame
query = "SELECT * FROM your_table"  # Replace 'your_table' with the actual table name
result = connection.execute(query)
df = pd.DataFrame(result.fetchall(), columns=result.keys())

# Transform or clean the data as needed (optional)
# For example, you can rename columns or perform data cleansing operations here.

# Save the DataFrame to a CSV file as your data warehouse
df.to_csv(output_csv_file, index=False)

# Close the database connection
connection.close()

print(f"Data warehouse created: {output_csv_file}")
