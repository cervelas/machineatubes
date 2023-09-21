'''import requests

url = "https://api.d-id.com/talks/tlk_aHPQJvRMXCubzZXhMGqNQ"

headers = {"accept": "application/json",
        "Authorization": "Basic c2FsdXRAbXluYW1laXNmdXp6eS5jaA:N51ON3CPUu3QXeujqjDKr"}

print(url, headers)
response = requests.get(url, headers=headers)

print(response)

response = response.json()

print(response.get("result_url"))'''

import time
import pprint
import rtmidi2 as rm

midi_outs = rm.get_out_ports()

pprint.pprint(midi_outs)


out = rm.MidiOut() # we may need more than one
out.open_port(0)


out.send_noteon(12, 129, 127)
time.sleep(0.2)
out.send_noteoff(12, 129)

'''out.send_noteon(14, 84, 127)
time.sleep(0.2)
out.send_noteoff(14, 84)

for n in range(12, 61):
    out.send_noteoff(15, n)

time.sleep(0.4)

for i in range(0, 0):
    for n in range(12, 61):
        out.send_noteon(15, n, 127)
        time.sleep(0.1)
        out.send_noteon(15, n+1, 127)
        time.sleep(0.1)

        out.send_noteoff(15, n)
        time.sleep(0.3)
        out.send_noteoff(15, n+1)
        time.sleep(0.3)'''

'''for n in range(12, 61):
    out.send_noteon(15, n, 127)

time.sleep(1)

for n in range(12, 61):
    out.send_noteoff(15, n)
'''