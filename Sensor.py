from flask import Flask, redirect, url_for, request,render_template
app = Flask(__name__)                                                 # Create Flask Object
import serial
                                     # Change your IP Address here
s = serial.Serial('COM2',9600)       # Define Serial  Communication Baud rate
f = serial.Serial('COM4',9500)
# p = serial.Serial('COM6',9400)

statusObj = {
   "gas": "NO",
   "flame": "NO",
   "ph": "NO"
}
flag = False

@app.route('/') 
@app.route('/index')                                  # Entry point for web servelet
def index():
   return render_template("index.html")  # Jump to home page

@app.route('/dashboard')                                                   # Entry point for web servelet
def dashboard():
   return render_template("dashboard.html", statusObj=statusObj)  # Jump to home page

@app.route('/loginservelate',methods = ['POST', 'GET'])
def loginservelate():
    global flag
    try:  
        username = request.form['username']                               # collect ID from webpage 
        password = request.form['password']                       # collect Password from webpage 
        if((str(username) == "Ck") and (str(password) == "1234")):   # compare ID and Password
            flag=1                                                       # if ID and Password is correct then only open bulb control web page
        else:
            flag=0                                                       # if ID and Password is not correct then open not succesfull webpage
        if(flag==1):                                                    # if ID and Password is correct then only open bulb control web page
            return render_template("dashboard.html", statusObj=statusObj) #Open User Home Page webpage
        else:
            return render_template("unsuccessfull.html",name=username)     # Open uncessfull webpage
    except:
        print("Error: unable to fetch data")      

@app.route('/login')                                                   # Entry point for web servelet
def login():
   return render_template("login.html")  # Jump to login page

@app.route('/Gas_Sensor',methods = ['POST', 'GET'])                   # If light OFF button press then open this servelet 
def Gas_Sensor():
   global flag 
   global statusObj
   status = request.form['gas_status']
   try:
      if(flag==1):                                                   # check valid user
         if status == "1":
            s.write(b'a')
            statusObj["gas"] = "YES"
         elif status == "0":
            s.write(b'b')
            statusObj["gas"] = "NO"                                               # Send 'b' value to proteus software when bulb off detected 
         return render_template("dashboard.html", statusObj=statusObj) #Refresh the control panel webpage after button press
      else:
         return render_template("login.html")  # If user name and password is not correct then after button press then jump to login page 
   except:
      print("Error: unable to fetch data")

@app.route('/Flame_Sensor',methods = ['POST', 'GET'])                   # If light OFF button press then open this servelet 
def Flame_Sensor():
   global flag 
   global statusObj
   status = request.form['flame_status']
   try:
      if(flag==1):                                                   # check valid user
         if status == "1":
            f.write(b'a')
            statusObj["flame"] = "YES"
         elif status == "0":
            f.write(b'b')
            statusObj["flame"] = "NO"                                               # Send 'b' value to proteus software when bulb off detected 
         return render_template("dashboard.html", statusObj=statusObj) #Refresh the control panel webpage after button press
      else:
         return render_template("login.html")  # If user name and password is not correct then after button press then jump to login page 
   except:
      print("Error: unable to fetch data")

# @app.route('/Ph_Sensor',methods = ['POST', 'GET'])                   # If light OFF button press then open this servelet 
# def Ph_Sensor():
#    global flag 
#    global statusObj
#    status = request.form['ph_status']
#    try:
#       if(flag==1):                                                   # check valid user
#          if status == "1":
#             f.write(b'a')
#             statusObj["flame"] = "YES"
#          elif status == "0":
#             f.write(b'b')
#             statusObj["flame"] = "NO"                                               # Send 'b' value to proteus software when bulb off detected 
#          return render_template("dashboard.html", statusObj=statusObj) #Refresh the control panel webpage after button press
#       else:
#          return render_template("login.html")  # If user name and password is not correct then after button press then jump to login page 
#    except:
#       print("Error: unable to fetch data")

if __name__ == '__main__':
   app.run(port = 5000,debug = False)