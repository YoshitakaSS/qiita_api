#!/usr/bin/env python
# -*- coding: utf-8 -*-

import requests;
from bs4 import BeautifulSoup;
import json
import datetime
import os

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

def write_json(json_list, path):
    """
    @json_list : json
    @path : file path

    JSONファイル書き出し
    """
    with open(path, 'w') as f:
        f.write(json.dumps(json_list, ensure_ascii=False, indent=4, sort_keys=True, separators=(',', ':')))

def mkdir(path):
    os.makedirs(path, exist_ok=True)

def get_unique_list(seq):
    seen = []
    return [x for x in seq if x not in seen and not seen.append(x)]

def get_unique_tag(tag_lists):
    tags = []
    for v in tag_lists:
        for i in v:
            tags.append(i)
    return tags        

try:
    # Root URL
    url = "https://qiita.com/"

    headers = {
        "User-Agent" : "Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1"
    }

    items = []
    item_json = []
    result = []

    res = requests.get(url, headers=headers)

    # htmlをBeautifulSoupで扱う
    soup = BeautifulSoup(res.text, "html.parser")

    try:
        main_items = soup.find(class_="p-home_main") 

        for main_items in soup.find_all():
            if "data-hyperapp-props" in main_items.attrs:
                item_json.append(main_items["data-hyperapp-props"])
        items = json.loads(item_json[1])
    except:
        raise Exception("Not Found Json Dom Info")

    if 'edges' not in items['trend']:
        raise Exception("The expected list does not exist")

    try:
        item_detail_list = []
        tags_list = []
        author_list = []

        for edges in items['trend']['edges']:
            if 'uuid' not in edges['node']:
                raise Exception("Not Found UUID")

            uuid = edges['node']['uuid']

            title = edges['node']['title']
            likes = edges['node']['likesCount']
            article_url =  url + edges['node']['author']['urlName'] + '/items/' + uuid
            author_name = edges['node']['author']['urlName']
            create_at = datetime.datetime.now().date()
            tag_list = get_article_tags(article_url)

            item = {
                'article_title' : title,
                'article_url' : article_url,
                'article_id' : edges['node']['uuid'],
                'likes' : likes,
                'uuid' : uuid,
                'author_name' : author_name,
                'tag_list' : tag_list,
            }

            item_detail_list.append(item)
            tags_list.append(tag_list)
            author_list.append(author_name)

        mkdir('/mnt/json/list/')
        mkdir('/mnt/json/tag/')
        mkdir('/mnt/json/author/')

        # タグをuniqu化
        tags_list = get_unique_tag(tags_list)

        # jsonファイルを書き出し
        write_json(item_detail_list, f"/mnt/json/list/{today_date}.json")
        write_json(tags_list, f"/mnt/json/tag/{today_date}.json")
        write_json(author_list, f"/mnt/json/author/{today_date}.json")
    except:
        raise Exception("Can't Create Json")
    
except Exception as e:
    # jsonファイル作成失敗
    mkdir('/mnt/log/')
    with open(f'/mnt/log/{today_date}', 'w') as f:
        f.write(e)