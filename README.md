# metiztorg-outsource
 A platform for managing job openings, employment applications, and referral programs. Includes features such as a bonus calculator and a map of available positions.
***

### Jobs Page

There is a data source, Google Sheets, where information about job vacancies is stored: addresses, salary, number of available positions, status, and other details. This data is retrieved through **GoogleSheetsAPI.php**, which makes a request to the Google Sheets API and passes the data further for processing.

To avoid frequent API requests and prevent exceeding usage limits, the data is cached. The **Cache.php** script saves the data in a **cache.json** file, which remains valid for 2 hours. If the data in the cache is outdated, the process repeats: the information is requested again from Google Sheets, updated, and saved in the cache.

To display job vacancies on a map, the addresses need to be converted into coordinates (latitude and longitude). This is done through **YandexMapsAPI.php**, which uses the Yandex Geocoder API to geocode the addresses. The resulting coordinates are added to the job data and also saved in the cache.

In the browser, the data is displayed in two formats. The first is a **list of job vacancies**, where each vacancy is shown with details: address, salary, number of positions, status, etc. The second is a **map**, where markers are displayed based on the coordinates from the cache. Each marker corresponds to a job address, and clicking on it shows the details.

The logic is simple: if the cache is up-to-date (not older than 2 hours), the data is taken from **cache.json**, and the browser displays the list and the map. If the cache is outdated or missing, the process repeats: data is requested from Google Sheets, geocoded, saved in the cache, and the browser updates the list and the map.



![jobs_page](https://github.com/user-attachments/assets/17448725-8baa-45c3-bc6b-5436dc04db55)

---
### Main Page
*
***
### Join-us Page
*
***
### Assets
*
***
