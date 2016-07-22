#!/usr/bin/env /usr/local/bin/python

import textract, os, sys, getopt, urllib



from CvParser import *


# def main(argv):
#    inputfile = ''
#    outputfile = ''
#    try:
#       opts, args = getopt.getopt(argv,"hi:o:",["ifile=","ofile="])
#    except getopt.GetoptError:
#       print 'test.py -i <inputfile> -o <outputfile>'
#       sys.exit(2)
#    for opt, arg in opts:
#       if opt == '-h':
#          print 'test.py -i <inputfile> -o <outputfile>'
#          sys.exit()
#       elif opt in ("-i", "--ifile"):
#          inputfile = arg
#          print textract.process(inputfile)
#       elif opt in ("-o", "--ofile"):
#          outputfile = arg
#    print 'Input file is "', inputfile
#    print 'Output file is "', outputfile

# if __name__ == "__main__":
#    main(sys.argv[1:])



# f = open( cur_dir + "/blah.txt", 'w' )
# f.write(text)
# f.close()

# parser = magicStripper(text)
# parser.do_parse()

# print parser.parsed_sections

from flask import Flask
from flask import request
app = Flask(__name__)

@app.route('/extract')
def extract_content():
	file_name = urllib.unquote( request.args.get('file_name') ).decode('utf8') 
	#request.args.get('file_name')
	print file_name
	text = textract.process(file_name)
	return text

if __name__ == '__main__':
    app.run()

