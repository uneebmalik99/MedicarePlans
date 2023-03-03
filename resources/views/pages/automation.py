import sys
import requests
from datetime import datetime, timezone, timedelta,date
import sys
import json
import dbconnection_update
from threading import Timer
import time
phone  =  sys.argv[1]
last_id = sys.argv[2]
#print("test")
#file1 = open("logging.txt", "a")  # append mode
#file1.write("File Opened")

def get_time_stamp(offset=0):
    #returns the date in a format usable by cake
    today = datetime.now(timezone.utc) - timedelta(hours=-(offset))
    time_stamp = today.strftime('%Y-%m-%dT%H:%M:%SZ')
    return time_stamp


# def get_time_stamp(offset=0):
#     #returns the date in a format usable by cake
#     today = datetime.now(timezone.utc) - timedelta(hours=-(offset))
#     time_stamp = today.strftime('%Y-%m-%dT%H:%M:%SZ')
#     return time_stamp

def getAllCalls():
#    file1.write("Getting All Calls")
    startTime = get_time_stamp(-20)
    endTime = get_time_stamp(0)
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
    
    return response.text


def check_phone(phone):
    phone = phone.replace("(","")
    phone = phone.replace(")","")
    phone = phone.replace(" ","")
    phone = phone.replace("-","")
    phone = "+1" + phone
    item = getAllCalls()
    item = json.loads(item)
    new_item = [];
    report =item['report']['records']
    # for k,v in item['report']['records']:
        

        
    for index in range(len(report)):
        for key in report[index]:
            new_item.append(report[index]['inboundPhoneNumber'])
    return (phone in new_item)
                



                
    
            
if __name__ == "__main__":
    
	#file1.write(f"About to check phone {phone}")
    ringba  = check_phone(phone)
    record  = dbconnection_update.conn_db(last_id,ringba)
	time.sleep(180)
    #            $postRequest = [
        #     "lp_campaign_id" => "63eabc1693191",
        #     "lp_campaign_key" => "Njd4gbvxL7GzJKXn6Hty",
        #     "first_name" => $row['first_name'],
        #     "last_name" => $row['last_name'] ?? null,
        #     "lp_response" => "JSON",
        #     "lp_s1" => $row['s1_id'],
        #     "lp_s2" => $row['s2_id'],
        #     "lp_s3" => $row['s3_id'],
        #     "lp_s4" => $row['s4_id'],
        #     "lp_s5" => $row['s5_id'],
        #     "transaction_id" => $row['transaction_id'],
        #     "affiliate_id" => $row['aff_id'],
        #     // "address" => $address,
        #     "phone_home" => $row['phone'],
        #     // "zip_code" => $zip_code,
        #     // "state" => $state,
        #     // "city" => $city,
        #     "age_range" => $row['age'],
        #     "monthly_income" => $row['income'],
        #     "On_Medicare" => $row['medicare_id'],
        #     "email_address" => $row['email'],
        #     "jornaya_lead_id" => $row['universal_lead_id'],
        #     "trusted_form_cert_id" => $row['xxTrustedFormCertUrl'],
        #     "ringba_call" => $row['ringba_call']
        # ];
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
        #     "email_address" => $row['email'],
        "jornaya_lead_id" : record[20],
        "trusted_form_cert_id" : record[22],
        "ringba_call" : record[23],
        "gender" : record[24]
    }
    #print(post_array)
    api_url = "https://rubicon.leadspediatrack.com/post.do"

    response = requests.post(api_url, data=post_array)
    print(f'post_array {post_array}\n ')
    print(response.json())