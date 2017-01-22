import os

directory = '/Users/Sciron/Documents/public_html'
files = os.listdir(directory)


php = filter(lambda x: x.endswith('.php'), files) 
html = filter(lambda x: x.endswith('.html'), files) 

php_html = php + html
print	php_html

for i in php_html:
	
		print i 
		file = i
		f = open(file, 'r')
		#print f.readlines()
		wb = 'wysiwygwebb'
		temp = ''
		for i in f.readlines():
			
			if wb in i:
				print i
			else: temp += i
		f.close()
		f = open(file, 'w')
		f.writelines(temp)
		f.close

	