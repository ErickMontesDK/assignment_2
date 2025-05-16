#!/usr/bin/env python3
import sys
import math
import json
import datetime

a=float(sys.argv[1])
b=float(sys.argv[2])
c=float(sys.argv[3])
response = {}

if a == 0:
    response["error"]= "The first number can't be 0. Not valid operation"

else:
    step1 = c**3
    step2 = math.sqrt(step1)
    step3 = step2 / a
    step4 = step3 * 10
    step5 = step4 + b


    def formatNumbers(n):
        if n == int(n):
            return f"{n:.1f}"
        elif round(n, 2) * 10 == int(round(n, 2) * 10):
            return f"{n:.1f}" 
        else:
            return f"{n:.2f}"  
        
    date = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")

    response["step1"] = formatNumbers(step1)
    response["step2"] = formatNumbers(step2)
    response["step3"] = formatNumbers(step3)
    response["step4"] = formatNumbers(step4)
    response["step5"] = formatNumbers(step5)
    response["date"] = date

print(json.dumps(response))