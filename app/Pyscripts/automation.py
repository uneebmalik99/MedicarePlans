import sys
import requests
from datetime import datetime, timezone, timedelta,date
import sys
import json
import dbconnection_update
from threading import Timer
import time
import re
phone  =  sys.argv[1]
last_id = sys.argv[2]
#print("test")
#file1 = open("logging.txt", "a")  # append mode
#file1.write("File Opened")

def get_time_stamp(offset=0):
	#returns the date in a format usable by cake
	today = datetime.now(timezone.utc) - timedelta(minutes=-(offset))
	time_stamp = today.strftime('%Y-%m-%dT%H:%M:%SZ')
	return time_stamp


# def get_time_stamp(offset=0):
#	 #returns the date in a format usable by cake
#	 today = datetime.now(timezone.utc) - timedelta(hours=-(offset))
#	 time_stamp = today.strftime('%Y-%m-%dT%H:%M:%SZ')
#	 return time_stamp

def getAllCalls():
	#file1.write("Getting All Calls")
	startTime = get_time_stamp(-30)
	endTime = get_time_stamp(0)
	#file1 = open("logging.txt", "a")  # append mode
	#file1.write(startTime)
	#file1.write(" ")
	#file1.write(endTime)
	headers = {
		'Authorization': f'Token 09f0c9f02d1046189b0f6b42a61a9ee4e966a3d88df88ba0b29a61e99832c7f63ef1c66e8a73ad7d9013b7221a6ae25bd5dc0dac9f447f97576d9a77d96db4c79407f598469024a9e741c0a69099ff10cd742681537c2280dda9f363b6d41a2d52e4dcca1836da96c4f6230cfe026360b538f112',
	}
	

	json_data = {
		'reportStart': startTime,
		'reportEnd': endTime,
		'orderByColumns': [
			{
				'column': 'inboundPhoneNumber',
				'direction': 'desc',
			},
		],
		# 'filters': [
		# ],
		'valueColumns': [
			{
				'column': 'callDt',
			},
			{
				'column': 'payoutAmount',
			},
			{
				'column': 'inboundPhoneNumber',
			},
			{
				'column': 'tag:InboundNumber:State',
			},
		],
		'formatTimespans': True,
		'formatPercentages': True,
		'formatDateTime': True,
		'formatTimeZone': 'America/New_York',
		'size': 1000,
		'offset': 0,
	}

	response = requests.post(
		'https://api.ringba.com/v2/RA3e4f3ab4851a447f8ca3efa1ef7b7c1f/calllogs',
		headers=headers,
		json=json_data,
	)
	#print(response.text)
	return response.text


def check_phone(phone):
#	phone = phone.replace("(","")
#	phone = phone.replace(")","")
#	phone = phone.replace(" ","")
#	phone = phone.replace("-","")
	phone = re.sub('[^0-9]','', phone)
	phone = "+1" + phone
	item = getAllCalls()
	item = json.loads(item)
	new_item = []
	report =item['report']['records']
	# for k,v in item['report']['records']:
		
	print(f"Checking Phone {phone}")
		
	for index in range(len(report)):
		for key in report[index]:
			new_item.append(report[index]['inboundPhoneNumber'])
	return (phone in new_item)	   

				  


def checkNumberTrestle(phoneNum):
	response = requests.get(f"https://api.trestleiq.com/3.0/caller_id?api_key=L8C1uSXgeZEep8QxnpDAWwtDw1ZTmM42G1o5q4UJ6A8GuFx8&phone={phoneNum}")
	return response.text

def formatTrestleData(dat):
	# dat = checkNumber("3143273763")
	# dat = '{"id":"Phone.1b54e592-c23a-4f16-b221-f9bd35ea1642","phone_number":"+13143273763","is_valid":true,"country_calling_code":"1","line_type":"Mobile","carrier":"T-Mobile USA, Inc.","is_prepaid":false,"is_commercial":false,"belongs_to":{"id":"Person.234c3bb5-455e-3cfc-9b2d-dfc8529691a2","name":"Kevin  Williams","firstname":"Kevin","middlename":null,"lastname":"Williams","alternate_names":[],"age_range":"61-65","gender":"M","type":"Person","industry":null,"link_to_phone_start_date":"2013-11-07"},"current_addresses":[{"id":"Location.8447b8c6-9582-4573-8d00-2007a55cee8c","location_type":"Address","street_line_1":"8501 Oxford Ln","street_line_2":null,"city":"Saint Louis","postal_code":"63147","zip4":"1234","state_code":"MO","country_code":null,"lat_long":{"latitude":38.71525,"longitude":-90.25216,"accuracy":"RoofTop"},"is_active":null,"delivery_point":null,"link_to_person_start_date":"1998-11-14","link_to_person_end_date":null}],"error":null,"warnings":[]}'

	jsonDat = json.loads(dat)

	newDict = {
			"lp_campaign_id" : "63eabc1693191",
			"lp_campaign_key" : "Njd4gbvxL7GzJKXn6Hty"
		}

	newMap = {}
	try:
		fName = jsonDat['belongs_to']['firstname']
		newMap['fName'] = fName
	except:
		fName = ""
	try:
		lName = jsonDat['belongs_to']['lastname']
		newMap['lName'] = lName
	except:
		lName = ""
	try:
		ageRange = jsonDat['belongs_to']['age_range']
		newMap['ageRange'] = ageRange
	except:
		ageRange = ""
	try:
		gender = jsonDat['belongs_to']['gender']
		newMap['gender'] = gender
	except:
		gender = ""
	try:
		streetLineOne = jsonDat['current_addresses'][0]['street_line_1']
		newMap['streetLineOne'] = streetLineOne
	except:
		streetLineOne = ""
	try:
		city = jsonDat['current_addresses'][0]['city']
		newMap['city'] = city
	except:
		city = ""
	try:
		postalCode = jsonDat['current_addresses'][0]['postal_code']
		newMap['postalCode'] = postalCode
	except:
		postalCode = ""
	try:
		stateCode =  jsonDat['current_addresses'][0]['state_code']
		newMap['stateCode'] = stateCode
	except:
		stateCode = ""

	return newMap


		
if __name__ == "__main__":
	
		#file1.write(f"About to check phone {phone}")
		#file1 = open("logging.txt", "a")  # append mode
		print("Hello")
		time.sleep(5)
		ringba = check_phone(phone)
		record = dbconnection_update.conn_db(last_id,ringba)

		startTime = get_time_stamp(-30)
		endTime = get_time_stamp(0)		
		#file1 = open("logging.txt", "a")  # append mode
		#file1.write(str(record))
		post_array = {
			"lp_campaign_id" : "63eabc1693191",
			"lp_campaign_key" : "Njd4gbvxL7GzJKXn6Hty",
			"first_name" : record[8],
			"last_name":record[9],
			"phone_home":record[10],
			"email_address":record[11],
			"lp_response" : "JSON",
			"lp_s1" : record[12],
			"lp_s2" : record[13],
			"lp_s3" : record[14],
			"lp_s4" : record[15],
			"lp_s5" : record[16],
			"transaction_id" : record[17],
			"affiliate_id" : record[18],
			"age_range" : record[1],
			"monthly_income" : record[2],
			"On_Medicare" : record[3],
			#	 "email_address" => $row['email'],
			"jornaya_lead_id" : record[20],
			"trusted_form_cert_id" : record[21],
			"ringba_call" : ringba,
			"gender" : record[24]
		}

		phoneStripped = re.sub('[^0-9]','', phone)
		dat = checkNumberTrestle(phoneStripped)
		addlDat = formatTrestleData(dat)

		try:
			if addlDat['ageRange']!="":
				post_array['age_range'] = addlDat['ageRange']
		except:
			pass
		try:
			if addlDat['streetLineOne']!="":
				post_array['address'] = addlDat['streetLineOne']
		except:
			pass

		try:
			if addlDat['city']!="":
				post_array['city'] = addlDat['city']
		except:
			pass

		try:
			if addlDat['postalCode']!="":
				post_array['zip_code'] = addlDat['postalCode']
		except:
			pass

		try:
			if addlDat['stateCode']!="":
				post_array['state'] = addlDat['stateCode']
		except:
			pass

			
		#print(post_array)
		api_url = "https://rubicon.leadspediatrack.com/post.do"

		response = requests.post(api_url, data=post_array)
		print(f'post_array {post_array}\n ')
		print(response.json())