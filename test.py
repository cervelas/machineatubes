import requests

url = "https://api.d-id.com/talks/tlk_aHPQJvRMXCubzZXhMGqNQ"

headers = {"accept": "application/json",
        "Authorization": "Basic c2FsdXRAbXluYW1laXNmdXp6eS5jaA:N51ON3CPUu3QXeujqjDKr"}

print(url, headers)
response = requests.get(url, headers=headers)

print(response)

response = response.json()

print(response.get("result_url"))