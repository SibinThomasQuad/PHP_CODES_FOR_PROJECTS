import pandas as pd
from sqlalchemy import create_engine, inspect

# MySQL database connection settings
mysql_config = {
    'host': 'localhost',  # Replace with your MySQL host
    'user': 'username',   # Replace with your MySQL username
    'password': 'password',  # Replace with your MySQL password
    'database': 'your_database',  # Replace with your MySQL database name
}

# Create a MySQL database connection
mysql_url = f"mysql+pymysql://{mysql_config['user']}:{mysql_config['password']}@{mysql_config['host']}/{mysql_config['database']}"
engine = create_engine(mysql_url)

# Get a list of all tables in the database
inspector = inspect(engine)
table_names = inspector.get_table_names()

# Data warehouse settings
output_folder = 'data_warehouse'  # Specify the folder where JSON files will be saved

# Iterate through each table and extract data to JSON
for table_name in table_names:
    output_json_file = f"{output_folder}/{table_name}.json"

    # Extract data from the table and load it into a pandas DataFrame
    query = f"SELECT * FROM {table_name}"
    result = engine.execute(query)
    df = pd.DataFrame(result.fetchall(), columns=result.keys())

    # Transform or clean the data as needed (optional)
    # For example, you can rename columns or perform data cleansing operations here.

    # Save the DataFrame to a JSON file as your data warehouse
    df.to_json(output_json_file, orient='records')  # 'records' format for JSON

    print(f"Data warehouse created for table: {table_name} -> {output_json_file}")

# Close the database connection
engine.dispose()
