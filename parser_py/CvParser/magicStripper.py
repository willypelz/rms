import re
from email.utils import parseaddr

class magicStripper:
	""" This is where all the magic happens , regexs and all for the parsing,  """

	document = "" # The string mined from the document
	parsed_sections = {} # A dictionary cotaining all parsed sections
	working_document = "" # The last version of the parsed document

	def __init__(self, text):
		self.document = text
		self.working_document = text

	def do_parse(self):
		self._get_email_addresses()

	def __update_working_document(self):
		""" Updates the working document to the current version of the document after working on it """
		self

	def _get_email_addresses(self):

		#remove email label
		re_email_label = re.search(r'e\-*mail[s]*\s*(address)*(es)*\s*:*\-*\.*', self.working_document, re.I);
		

		re_email = re.findall( r'[a-zA-Z0-9._%-]+@[a-zA-Z0-9._%-]+.[a-zA-Z]{2,6}', self.working_document, re.IGNORECASE )
		print re_email
		self.parsed_sections['emails'] = re_email


