#echo "<?php echo \"`git rev-list HEAD --count`\";" > version.php
# echo $(git rev-list HEAD --count) >> version.php
# echo "\";" >> version.php
require 'date'

p   Described = (IO::popen('git describe --long') { |gs| gs.read }).to_s
p   Number = Described.gsub('-', '.').gsub(/^v/, '').split('.')[0..-2].join('.')
#p   Date = Date.strptime( IO::popen('git show -s --format="%ct"') { |gs| gs.read } , "%s")
p   iDate = (IO::popen('git show -s --format="%cD"') { |gs| gs.read }).to_s
p   Revision = (IO::popen('git show -s --format="%H"') { |gs| gs.read }).to_s

pas = '<?php echo \'Version ' << Number.to_s << ' at ' << iDate.to_s << '\';'

fileAnsver = File.open("./version.php", "w")
fileAnsver.write(pas)