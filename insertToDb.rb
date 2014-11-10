#!/usr/bin/ruby
# temperature   pressure    humidity    light 
require 'mysql'
require 'time'
require 'date'

def insert(con)
	    con.query("CREATE TABLE IF NOT EXISTS inform(Id INT PRIMARY KEY AUTO_INCREMENT, temperature  INT(3), pressure INT(3), humidity INT(4), light INT(1),time TIMESTAMP)")
        p "start write"
    100.times do
    	str = "INSERT INTO inform(temperature, pressure, humidity, light, time) VALUES('#{rand(20 .. 40).to_s}', '#{rand(0 .. 100).to_s}', '#{rand(720 .. 800).to_s}','#{rand(0 .. 1).to_s}',CURRENT_TIMESTAMP())"
        p "Sucsesfull :: " + str
        con.query(str)
        sleep(10)
    end
end

def delete(con)
	con.query "DROP TABLE inform"
	p "Sucsesfull delete all"
end

def select(con)
	p con.query "SELECT `light` FROM `inform` WHERE `Id` = (SELECT MAX( `Id` )FROM `inform` )"
	p "Sucsesfull select"
end

begin
    p "strart + #{DateTime.now}"
    con = Mysql.new 'localhost', 'root', 'mys1234!@#$', 'data'
    p "connect"
    insert(con)
    p "insert"
    #select(con)
    #delete(con)
rescue Mysql::Error => e
    puts e.errno
    puts e.error
    
ensure
    con.close if con
end
