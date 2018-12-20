#!/usr/bin/env python

import time
import RPi.GPIO as GPIO
import sys
import argparse

# construct the argument parse and parse the arguments
ap = argparse.ArgumentParser()
ap.add_argument("-i", "--pin", help = "path to the video file")
args = vars(ap.parse_args())
argN = sys.argv[-1]

argN = int(argN)

def relayOn(argN):
	
	pin = int(argN) #pass the arguments into header pin
	GPIO.setmode(GPIO.BCM)
	GPIO.setup(pin, GPIO.OUT)
	GPIO.output(pin, GPIO.HIGH)
	#GPIO.cleanup()

relayOn(argN)
