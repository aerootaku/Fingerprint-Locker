#!/usr/bin/env python
# -*- coding: utf-8 -*-
import urllib2, urllib
import hashlib
from pyfingerprint.pyfingerprint import PyFingerprint


## Search for a finger
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

## Tries to search the finger and calculate hash
try:
    print('Waiting for finger...')

    ## Wait that finger is read
    while ( f.readImage() == False ):
        pass

    ## Converts read image to characteristics and stores it in charbuffer 1
    f.convertImage(0x01)

    ## Searchs template
    result = f.searchTemplate()

    positionNumber = result[0]
    accuracyScore = result[1]

    if ( positionNumber == -1 ):
        print('No match found!')
        #exit(0)
    else:
        print (positionNumber)
        # print('Found template at position #' + str(positionNumber))
        # print('The accuracy score is: ' + str(accuracyScore))
        savedata = positionNumber
        mydata=[('one',savedata)]    #The first is the var name the second is the value
        mydata=urllib.urlencode(mydata)
        path='http://localhost/locker/superadmin/fingerprint.php'    #the url you want to POST to
        req=urllib2.Request(path, mydata)
        req.add_header("Content-type", "application/x-www-form-urlencoded")
        page=urllib2.urlopen(req).read()

    ## OPTIONAL stuff
    ##

    ## Loads the found template to charbuffer 1
    f.loadTemplate(positionNumber, 0x01)

    ## Downloads the characteristics of template loaded in charbuffer 1
    characterics = str(f.downloadCharacteristics(0x01)).encode('utf-8')

    ## Hashes characteristics of template
    print('SHA-2 hash of template: ' + hashlib.sha256(characterics).hexdigest())

except Exception as e:
    print('Operation failed!')
    print('Exception message: ' + str(e))
    exit(1)
