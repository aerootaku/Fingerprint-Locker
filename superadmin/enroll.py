#!/usr/bin/env python
# -*- coding: utf-8 -*-
import time
from pyfingerprint.pyfingerprint import PyFingerprint
from db_config import read_db_config
from mysql.connector import MySQLConnection, Error

## Enrolls new finger
##

## Tries to initialize the sensor
try:
    f = PyFingerprint('/dev/ttyUSB0', 57600, 0xFFFFFFFF, 0x00000000)

    if ( f.verifyPassword() == False ):
        raise ValueError('The given fingerprint sensor password is wrong!')

except Exception as e:
    print('The fingerprint sensor could not be initialized!')
    print('Exception message: ' + str(e))
    exit(1)

## Gets some sensor information
print('Currently used templates: ' + str(f.getTemplateCount()) +'/'+ str(f.getStorageCapacity()))

## Tries to enroll new finger
## Main system - Will enroll fingerprint when the user matched it's fingerprint data

def insertFingerprint(template, fp_hash):
    query = "INSERT INTO tbl_fp(fp_template, fp_hash) VALUES (%s, %s)"
    args = (template, fp_hash) 
    try:
        db_config = read_db_config()
        conn = MySQLConnection(**db_config)

        cursor = conn.cursor()
        cursor.execute(query, args)
        conn.commit()
    except Error as e:
        raise ValueError('Error', e)
    finally:
        cursor.close()
        conn.close()
    
def main():
	try:
		#print('Waiting for finger...')

		## Wait that finger is read
		while ( f.readImage() == False ):
			pass

		## Converts read image to characteristics and stores it in charbuffer 1
		f.convertImage(0x01)

		## Checks if finger is already enrolled
		result = f.searchTemplate()
		positionNumber = result[0]

		if ( positionNumber >= 0 ):
			print('Template already exists at position #' + str(positionNumber))
			exit(0)

		## Wait that finger is read again
		while ( f.readImage() == False ):
			pass

		## Converts read image to characteristics and stores it in charbuffer 2
		f.convertImage(0x02)


		## Compares the charbuffers
		if ( f.compareCharacteristics() == 0 ):
			raise Exception('Fingers do not match')

		## Creates a template
		f.createTemplate()

		
		## Saves template at new position number
		positionNumber = f.storeTemplate()
		print('Finger enrolled successfully!')
		print('New template position #' + str(positionNumber))
		template = str(positionNumber)
		unq = f.generateRandomNumber()
		unqData = str(positionNumber) + str(unq)
		print('Generated Unique Fingerprint ID: ' + str(unqData))
		#print('Saving to database Server')
		insertFingerprint(template, unqData)
        

	except Exception as e:
		print('Operation failed!')
		print('Exception message: ' + str(e))
		exit(1)
        

main()
