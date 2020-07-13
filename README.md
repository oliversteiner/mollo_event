# Mollo Event

## Bundles and Fields:
### Bundle Event
#### Event
mollo_name
mollo_subtitle
mollo_description
mollo_notes
mollo_status (term)
mollo_works (ref)
mollo_artists (ref)
mollo_artist_groups (ref)
mollo_category (term)
mollo_locations (ref)



#### Medias
mollo_audio (media)
mollo_video (media)
mollo_images (media)
mollo_title_image (media)
mollo_galleries (ref -> UniG)
mollo_files (files)

#### Other
mollo_locations (ref)
mollo_social_media
mollo_booking_link

### Bundle Event Date
mollo_event (ref->event)
mollo_start (date)
mollo_end (date)
mollo_door_opening (date)
mollo_show_start (bool)
mollo_show_end (bool)
mollo_event_status (term)
mollo_event_number
mollo_description
mollo_notes
mollo_director (ref->Artist)
mollo_host (ref->Artist)


### Bundle Location
mollo_name
mollo_place
mollo_street_and_number
mollo_city
mollo_zip_code
mollo_country
mollo_map

### Vocabularies
mollo_event_category
mollo_event_status

### Bundle Work
mollo_name
mollo_composers
mollo_writers
