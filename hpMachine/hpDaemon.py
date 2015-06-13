import RPi.GPIO as gpio
from time import sleep
import urllib
import json

class Shifter():
  # pin setting
  rclk=10
  clock=12
  clearPin=8
  inputB=16

  # length of led
  outBitLength=16

  def __init__(self):
    self.setupBoard()
    self.pause=0
  def tick(self):
    gpio.output(Shifter.clock,gpio.HIGH)
    sleep(self.pause)
    gpio.output(Shifter.clock,gpio.LOW)
    sleep(self.pause)   
  def setValue(self,value):
    for i in range(24):
      bitwise=0x800000>>i
      bit=bitwise&value
      gpio.output(Shifter.rclk,gpio.LOW)
      if (bit==0):
        gpio.output(Shifter.inputB,gpio.LOW)
      else:
        gpio.output(Shifter.inputB,gpio.HIGH)
      gpio.output(Shifter.rclk,gpio.HIGH)
      Shifter.tick(self)
  def clear(self):
    gpio.output(Shifter.clearPin,gpio.LOW)
    Shifter.tick(self)
    gpio.output(Shifter.clearPin,gpio.HIGH)
  def setupBoard(self):
    #gpio.setup(Shifter.inputA,gpio.OUT)
    #gpio.output(Shifter.inputA,gpio.HIGH)
    gpio.setup(Shifter.inputB,gpio.OUT)
    gpio.output(Shifter.inputB,gpio.LOW)
    gpio.setup(Shifter.clock,gpio.OUT)
    gpio.output(Shifter.clock,gpio.LOW)
    gpio.setup(Shifter.clearPin,gpio.OUT)
    gpio.output(Shifter.clearPin,gpio.HIGH)
    gpio.setup(Shifter.rclk,gpio.OUT)
    gpio.output(Shifter.rclk,gpio.HIGH)
  def setHp(self, imax, icurrent):
    o = int(float(icurrent) / float(imax) * float(self.outBitLength))
    z = self.outBitLength - o
    print(z,o)
    for i in range(z):
      gpio.output(Shifter.rclk,gpio.LOW)
      gpio.output(Shifter.inputB,gpio.LOW)
      gpio.output(Shifter.rclk,gpio.HIGH)
      Shifter.tick(self)
    for i in range(o):
      gpio.output(Shifter.rclk,gpio.LOW)
      gpio.output(Shifter.inputB,gpio.HIGH)
      gpio.output(Shifter.rclk,gpio.HIGH)
      Shifter.tick(self)
  def readHp(self,link):
    #link = "http://10.0.0.79/api/get?barid=0"
    f = urllib.urlopen(link)
    o = json.loads(f.read())
    #print myfile
    self.clear()
    self.setHp(o["vol_max"], o["vol_current"])

def main():
  pause=1
  gpio.setmode(gpio.BOARD)
  shifter=Shifter()
  print("init done  ")
  link = "http://10.0.0.79/api/get?barid=0"
  running=True

  while running==True:
    try:
      #shifter.clear()
      shifter.readHp(link)
      sleep(pause)
    except KeyboardInterrupt:
      running=False

  #shifter.setHp(30,16)
  '''
  while running==True:
          try:
      shifter.clear()
      data=0x0FFFFFF
      print("write "+hex(data))
      shifter.setValue(data) #0x0AAAAAA
      sleep(pause)
      shifter.clear()
      data=0x0FFFFFF
      print("write "+hex(data))
      shifter.setValue(data) #0x0555555
      sleep(pause)
          except KeyboardInterrupt:
            running=False
      '''

if __name__=="__main__":
    main()

