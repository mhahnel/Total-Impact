#!/usr/bin/env python

import urllib2
import re

DRYAD_DOI_URL = "http://dx.doi.org/"
DRYAD_VIEWS_PATTERN = re.compile("(?P<views>\d+) views", re.DOTALL)

def get_dryad_page(doi):
    if not doi:
        return(None)
    query_url = DRYAD_DOI_URL + doi
    page = urllib2.urlopen(query_url).read()
    return(page)  

def get_number_views(page):
    if not page:
        return(None)
    view_matches = DRYAD_VIEWS_PATTERN.search(page)
    if not view_matches:
        return(None)
    try:
        views = float(view_matches.group("views"))
    except ValueError:
        return(None)
    return(views)  
        
test_doi = "10.5061/dryad.j1fd7"
page = get_dryad_page(test_doi)
views = get_number_views(page)
print views
