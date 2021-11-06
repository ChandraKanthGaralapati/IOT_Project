from flask import Flask, redirect, url_for, request,render_template
app = Flask(__name__)      # Create Flask Object

# Other Modules
import serial
# import Ports
# import pio
                                     
s = serial.Serial('COM2',9600)       
f = serial.Serial('COM4',9500)
# p = serial.Serial('COM6',9400)

i = serial.Serial('COM6',9400)

# pio.uart = Ports.UART()     # Module Object for trying to recieve the data from COM Port

statusObj = {
   "gas": "NO",
   "flame": "NO",
   "ph": "NO",
   "ir": "Obstacle Not Detected",
   'button1': 'OFF',
   'button2' : 'OFF'
}
flag = False

@app.route('/') 
@app.route('/index')                                  # Entry point for web servelet
def index():
   return render_template("index.html")               # Jump to home page

@app.route('/dashboard')                              # Entry point for dashbaord
def dashboard():
   return render_template("dashboard.html", statusObj=statusObj)  # Jump to dashboard page

@app.route('/loginservelate',methods = ['POST', 'GET'])           # Entry point for web servelet
def loginservelate():
    global flag
    try:  
        username = request.form['username']                       # collect username from webpage 
        password = request.form['password']                       # collect Password from webpage 
        if((str(username) == "Ck") and (str(password) == "1234")):# compare username and Password
            flag=1                                                # if username and Password is correct then set flag to 1
        else:
            flag=0                                                # if username or Password are not correct then set flag to 0
        
        if(flag==1):                                              # if flag was 1 open the Dash Board Web page
            return render_template("dashboard.html", statusObj=statusObj) # Open User Dashbaord Page webpage
        else:
            return render_template("unsuccessfull.html",name=username)    # Open unsuccessfull webpage
    except:
        print("Error: unable to fetch data")      

@app.route('/login')                                              # Entry point for login
def login():
   return render_template("login.html")                           # Jump to login page

@app.route('/Gas_Sensor',methods = ['POST', 'GET'])               # On Submit in Gas Sensor Section open this Servelet
def Gas_Sensor():
   global flag 
   global statusObj
   status = request.form['gas_status']
   try:
      if(flag==1):                                                # check valid user
         if status == "1":
            s.write(b'a')                                         # Send 'a' value to proteus software when Gas is passed
            s.timeout = 10
            # message = s.read(100)
            statusObj["gas"] = 'Yes'
         elif status == "0":
            s.write(b'b')                                         # Send 'b' value to proteus software when Gas is not passed
            s.timeout = 10
            # message = s.read(100)
            statusObj["gas"] = 'No'                                          
         return render_template("dashboard.html", statusObj=statusObj) # Refresh the control panel webpage after button press
      else:
         return render_template("login.html")  # If user name and password is not correct then after button press then jump to login page 
   except:
      print("Error: unable to fetch data")

@app.route('/Flame_Sensor',methods = ['POST', 'GET'])                   # On Submit in Flame Sensor Section open this Servelet
def Flame_Sensor():
   global flag 
   global statusObj
   status = request.form['flame_status']
   try:
      if(flag==1):                                                   # check valid user
         if status == "1":
            f.write(b'a')                                            # Send 'a' value to proteus software when Fire is lit
            statusObj["flame"] = "YES"
         elif status == "0":
            f.write(b'b')                                            # Send 'b' value to proteus software when Fire is put off
            statusObj["flame"] = "NO"
         return render_template("dashboard.html", statusObj=statusObj)# Refresh the control panel webpage after button press
      else:
         return render_template("login.html")  # If user name and password is not correct then after button press then jump to login page 
   except:
      print("Error: unable to fetch data")

# @app.route('/Ph_Sensor',methods = ['POST', 'GET'])                # On Submit in PH Sensor Section open this Servelet  
# def Ph_Sensor():
#    global flag 
#    global statusObj
#    status = request.form['ph_status']
#    try:
#       if(flag==1):                                                   # check valid user
#          if status == "1":
#             p.write(b'a')
#             statusObj["ph"] = "YES"
#          elif status == "0":
#             p.write(b'b')
#             statusObj["ph"] = "NO" 
#          return render_template("dashboard.html", statusObj=statusObj) #Refresh the control panel webpage after button press
#       else:
#          return render_template("login.html")  # If user name and password is not correct then after button press then jump to login page 
#    except:
#       print("Error: unable to fetch data")

@app.route('/IR_Sensor',methods = ['POST', 'GET'])                   # On Submit in IR Sensor Section open this Servelet
def IR_Sensor():
   global flag 
   global statusObj
   status = request.form['ir_status']
   try:
      if(flag==1):                                                   # check valid user
         if status == "1":
            i.write(b'a')                                            # Send 'a' value to proteus software when Obstacle is Placed
            statusObj["ir"] = "Obstacle Detected"
         elif status == "0":
            i.write(b'b')                                            # Send 'b' value to proteus software when Obstacle is Removed
            statusObj["ir"] = "Obstacle Not Detected"                
         return render_template("dashboard.html", statusObj=statusObj) # Refresh the control panel webpage after button press
      else:
         return render_template("login.html")  # If user name and password is not correct then after button press then jump to login page 
   except:
      print("Error: unable to fetch data")

if __name__ == '__main__':
   app.run(port = 5000,debug = False)