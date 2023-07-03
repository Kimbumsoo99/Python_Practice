import requests
from bs4 import BeautifulSoup
import urllib.request
import os


def download_images(query, count):
    # 검색어와 이미지 다운로드 개수를 파라미터로 받습니다.

    # 이미지를 저장할 폴더를 생성합니다.
    if not os.path.exists(query):
        os.makedirs(query)

    # 검색어로 Bing 이미지 검색 URL을 생성합니다.
    url = f"https://www.bing.com/images/search?q={query}&count={count}"

    # Bing 이미지 검색 페이지에 요청을 보냅니다.
    response = requests.get(url)
    soup = BeautifulSoup(response.text, 'html.parser')

    # 이미지 링크를 찾아서 다운로드합니다.
    image_links = soup.find_all('a', class_='thumb')

    for i, link in enumerate(image_links):
        image_url = link['href']

        # 이미지를 다운로드합니다.
        urllib.request.urlretrieve(image_url, f"{query}/{query}_{i+1}.jpg")

    print(f"{count}개의 이미지를 다운로드했습니다.")


# 이미지를 검색하고 다운로드합니다.
search_query = "사과"  # 검색어
image_count = 10  # 다운로드할 이미지 개수

download_images(search_query, image_count)
