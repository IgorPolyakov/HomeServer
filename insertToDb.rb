#!/usr/bin/ruby
# temperature   pressure    humidity    light 
require 'mysql'
require 'time'
require 'date'
require "serialport"
def insert(con, data)
	    con.query("CREATE TABLE IF NOT EXISTS inform(Id INT PRIMARY KEY AUTO_INCREMENT, temperature  INT(3), pressure INT(3), humidity INT(4), light INT(1),time TIMESTAMP)")
        p "start write"
    #100.times do
    	str = "INSERT INTO inform(temperature, pressure, humidity, light, time) VALUES('#{data[1].to_s}', '#{data[0].to_s}', '#{rand(720 .. 800).to_s}','#{rand(0 .. 1).to_s}',CURRENT_TIMESTAMP())"
        p "Sucsesfull :: " + str
        con.query(str)
        sleep(10)
    #end
end

def delete(con)
	con.query "DROP TABLE inform"
	p "Sucsesfull delete all"
end

def select(con)
	p con.query "SELECT `light` FROM `inform` WHERE `Id` = (SELECT MAX( `Id` )FROM `inform` )"
	p "Sucsesfull select"
end

# https://github.com/hparra/ruby-serialport
 
 
#params for serial port
port_str = "/dev/ttyUSB0"  #may be different for you
baud_rate = 9600
data_bits = 8
stop_bits = 1
data = ""

p "strart + #{DateTime.now}"
con = Mysql.new 'localhost', 'root', 'mys1234!@#$', 'data'
p "connect"
p "insert"

parity = SerialPort::NONE

sp = SerialPort.new(port_str, baud_rate, data_bits, stop_bits, parity)
while true do
	message = sp.gets
	if message
		message.chomp
		data = message.split(';')
		#p data[0]
		insert(con, data)
		

	end
end

sp.close
