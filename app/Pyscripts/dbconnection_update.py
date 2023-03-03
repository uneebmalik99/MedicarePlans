# Importing module
import mysql.connector
from mysql.connector import Error
#localhost","uneeb","I#3css766","admin_heathcare
def conn_db(id,ringba): 
    try:
        # Creating connection object
        mysql_conn = mysql.connector.connect(
            host = "localhost",
            database = "medicare_pronto",
            user = "root",
            password = ""
        )
        # Printing the connection object
        if mysql_conn.is_connected():
            db_info =  mysql_conn.get_server_info()
           # print("Connected to MySQL server version",db_info)
            cursor = mysql_conn.cursor()
            cursor.execute("SELECT database();")
            record = cursor.fetchone()
           # print("You're connected to database:", record)
           # print("Before updating a record ")
            sql_select_query = f'select * from questionare where id = {id}'
            # Update single record now
            sql_update_query = f'Update questionare set ringba_call = {str(ringba)} where id = {id}'
            cursor.execute(sql_update_query)
            mysql_conn.commit()
            #print("Record Updated successfully ")

            #print("After updating record ")
            cursor.execute(sql_select_query)
            record = cursor.fetchone()
            return record
    except Error as e:
            print("Failed to update table record: {}".format(e))
    finally:
         if mysql_conn.is_connected():
               cursor.close()
               mysql_conn.close()
               #print("MySQL connection is closed")



#print(conn_db(43 ,"True"))