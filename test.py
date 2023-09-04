import requests
import pprint
import json

url = "https://api.d-id.com/talks/tlk_f-3ESOh3r70FrHGbG_ROD"

headers = {"accept": "application/json", "Authorization": "Basic c2FsdXRAbXluYW1laXNmdXp6eS5jaA:tRC26DHV5mh-8mJwJ86HZ"}

response = requests.get(url, headers=headers)

pprint.pprint(json.loads(response.text)["result_url"])