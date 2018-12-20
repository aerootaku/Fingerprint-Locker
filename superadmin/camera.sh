#!/bin/bash

DATE=$(date +"%Y-%m-%d_%H%M")

raspistill -n -vf -hf -o /home/pi/capture/$DATE.jpg
