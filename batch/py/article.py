import requests;
from bs4 import BeautifulSoup;
import json
import datetime

today_date = datetime.datetime.now().date()

def get_article_tags(detail_url):
    """
    @detail_url : article url

    記事に付けられているタグの一覧を取得する
    """
    tag_list = []

    res = requests.get(detail_url, headers=headers)

    # htmlをBeautifulSoupで扱う
    soup = BeautifulSoup(res.text, "html.parser")

    tags = soup.find_all(class_="it-Tags_item")
    for tag in tags:
        tag_name = tag.get_text()
        tag_link = tag.get('href')

        tag_list.append({
            'tag_name' : tag_name,
            'tag_link': tag_link
        })

    return tag_list

def write_json(json_list):
    # jsonファイルを書き出し
    with open(f'/mnt/json/{today_date}.json', 'w') as f:
        f.write(json.dumps(json_list, ensure_ascii=False, indent=4, sort_keys=True, separators=(',', ':')))

try:
    # Root URL
    url = "https://qiita.com/"

    headers = {
        "User-Agent" : "Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1"
    }

    item_json = []
    item_detail_json = []
    result = []

    res = requests.get(url, headers=headers)

    # htmlをBeautifulSoupで扱う
    soup = BeautifulSoup(res.text, "html.parser")

    try:
        items = soup.find(class_="p-home_main") 

        for items in soup.find_all():
            if "data-hyperapp-props" in items.attrs:
                item_json.append(items["data-hyperapp-props"])
    except:
        raise Exception("Not Found Json Dom Info")

    items = json.loads(item_json[1])

    try:
        for edges in items['trend']['edges']:
            title = edges['node']['title']
            likes = edges['node']['likesCount']
            article_url =  url + edges['node']['author']['urlName'] + '/items/' + edges['node']['uuid']
            author_name = edges['node']['author']['urlName']
            create_at = datetime.datetime.now().date()
            tag_list = get_article_tags(article_url)

            item = {
                'title' : title,
                'likes' : likes,
                'article_url' : article_url,
                'author_name' : author_name,
                'tag_list' : tag_list
            }

            item_detail_json.append(item)

        # jsonファイルを書き出し
        write_json(item_detail_json)
    except:
        raise Exception("Can't Create Json")
    
except Exception as e:
    # jsonファイル作成失敗
    with open(f'/mnt/log/{today_date}', 'w') as f:
        f.write(e)