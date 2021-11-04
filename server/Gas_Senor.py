from flask import Flask, redirect, url_for, request,render_template
app = Flask(__name__)                                                 # Create Flask Object
import serial

Url_Address = "127.0.0.1"                                      # Change your IP Address here
s = serial.Serial('COM2',9600)                                        # Define Serial  Communication Baud rate

flag = False

@app.route('/')                                                   # Entry point for web servelet
def index():
   return render_template("../web/index.html",HTML_address=Url_Address)  # Jump to home page


# @app.route('/loginservelate',methods = ['POST', 'GET'])
# def loginservelate():
#     global flag
#     try:  
#         username = request.form['username']                               # collect ID from webpage 
#         password = request.form['password']                       # collect Password from webpage 
#         if((str(username) == "Ck") and (str(password) == "1234")):   # compare ID and Password
#             flag=1                                                       # if ID and Password is correct then only open bulb control web page
#         else:
#             flag=0                                                       # if ID and Password is not correct then open not succesfull webpage
#         if(flag==1):                                                    # if ID and Password is correct then only open bulb control web page
#             return render_template("../web/user/dashboard.html",HTML_address=Url_Address) #Open User Home Page webpage
#         else:
#             return render_template("###",name=username)     # Open uncessfull webpage
#     except:
#         print("Error: unable to fetch data")      

# @app.route('/login')                                                   # Entry point for web servelet
# def login():
#    return render_template("../web/login.html",HTML_address=Url_Address)  # Jump to login page

# @app.route('/Gas_SensorON',methods = ['POST', 'GET'])                      # If light ON button press then open this servelet 
# def Gas_SensorON():                                                        
#    global flag 
#    try:
#       if(flag==1):                                                     # check valid user
#          s.write(b'a')                                                 # Send 'a' value to proteus software when bulb on detected 
#          return render_template("###",HTML_address=Url_Address)  #Refresh the control panel webpage after button press
#       else:
#          return render_template("login.html",HTML_address=Url_Address)  # If user name and password is not correct then after button press then jump to login page 
#    except:
#       print("Error: unable to fetch data")

# @app.route('/Gas_SensorOff',methods = ['POST', 'GET'])                   # If light OFF button press then open this servelet 
# def Gas_SensorOff():
#    global flag 
#    try:
#       if(flag==1):                                                   # check valid user
#          s.write(b'b')                                               # Send 'b' value to proteus software when bulb off detected 
#          return render_template("###",HTML_address=Url_Address) #Refresh the control panel webpage after button press
#       else:
#          return render_template("login.html",HTML_address=Url_Address)  # If user name and password is not correct then after button press then jump to login page 
#    except:
#       print("Error: unable to fetch data")



if __name__ == '__main__':
   app.run(port = 5000,debug = False)