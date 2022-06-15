# Api
Make a login function as well as a function to get a list of cats details from the web

# Note
This project is used php for development purpose to get a list of cats details from a url and return in a json object

if want to run on local it would be below's url
##[Login] (http://localhost/apis/index.php?svc=login) :

This is a post method request where it need to pass in details as below in order for us to get the tokens
request
```
{
    "data":{
        "username":"admin",
        "password":"test1234"
    }
}
```
respone
```
{
    "token": "c/tXXiuGpJxvtZSNbDLixAwonw8sTdnZQdHyzCMJZqyn5XksWJC/fn6o15Z4B7UvIfRyXKUenzgcfJgbxyvg8EyPyzQ7Qw==",
    "Created": "15/06/22 07:49pm",
    "Valid": "15/06/22 08:49pm"
}
```
##[Get] (http://localhost/apis/index.php?svc=get) :

This would require get method with the autentication set to bearer <token>
This would get a limit of 100 records from url
respone
```
{
    "data": [
        {
            "weight": {
                "imperial": "7  -  10",
                "metric": "3 - 5"
            },
            "id": "abys",
            "name": "Abyssinian",
            "cfa_url": "http://cfa.org/Breeds/BreedsAB/Abyssinian.aspx",
            "vetstreet_url": "http://www.vetstreet.com/cats/abyssinian",
            "vcahospitals_url": "https://vcahospitals.com/know-your-pet/cat-breeds/abyssinian",
            "temperament": "Active, Energetic, Independent, Intelligent, Gentle",
            "origin": "Egypt",
            "country_codes": "EG",
            "country_code": "EG",
            "description": "The Abyssinian is easy to care for, and a joy to have in your home. They’re affectionate cats and love both people and other animals.",
            "life_span": "14 - 15",
            "indoor": 0,
            "lap": 1,
            "alt_names": "",
            "adaptability": 5,
            "affection_level": 5,
            "child_friendly": 3,
            "dog_friendly": 4,
            "energy_level": 5,
            "grooming": 1,
            "health_issues": 2,
            "intelligence": 5,
            "shedding_level": 2,
            "social_needs": 5,
            "stranger_friendly": 5,
            "vocalisation": 1,
            "experimental": 0,
            "hairless": 0,
            "natural": 1,
            "rare": 0,
            "rex": 0,
            "suppressed_tail": 0,
            "short_legs": 0,
            "wikipedia_url": "https://en.wikipedia.org/wiki/Abyssinian_(cat)",
            "hypoallergenic": 0,
            "reference_image_id": "0XYvRd7oD",
            "image": {
                "id": "0XYvRd7oD",
                "width": 1204,
                "height": 1445,
                "url": "https://cdn2.thecatapi.com/images/0XYvRd7oD.jpg"
            }
        }
    ]
}
```
