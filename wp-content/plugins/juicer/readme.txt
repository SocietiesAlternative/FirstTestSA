=== Embed, curate & aggregate social media feeds into your website using JUICER ===
Contributors: weckersham
Tags: social media feed, embed social media, social media aggregator, embed Facebook feed, embed Twitter feed, embed Instagram, embed YouTube, embed TikTok, embed Pinterest, embed LinkedIn, embed Vimeo, instagram gallery, tiktok gallery
Donate link: https://wp.juicer.io
Requires at least: 3.0
Tested up to: 5.9.2
Stable tag: 1.9.3
License: GPLv2

Embed, curate & aggregate social media feeds from Instagram, Twitter, TikTok, Facebook, LinkedIn, YouTube, Slack, etc. and customize them as you like.

== Description ==
Juicer is a service that allows you to enter in the name of your social media accounts (or, if you prefer, hashtags) and Juicer will automatically pull the posts from these feeds and embed them into any of your pages with an easy shortcode. Juicer will automatically update these feeds whenever you create posts for your social media accounts. If you like, you can also curate these feeds easily within Juicer.

To use this plugin you must create an account on [wp.juicer.io](https://wp.juicer.io). Then you must create a feed and add social media sources to it.

= Features =

* A beautiful social media feed of your social media content from basically networks: Facebook, Twitter, Instagram, YouTube, Pinterest, Tumblr, RSS, Slack, LinkedIn, Flickr, Vimeo, Hashtags and Yelp.
* Gather your content by @username or #hashtag
* Setup rules & filters to automatically eliminate unwanted content retweets and duplicate posts.
* Moderate and remove your social media content with one click.
* Permalinks to each of your social media posts, optimized for SEO.
* Responsive grid for dynamic layouts.
* Infinite scroll: load more content simply by scrolling to the bottom of the page.
* Auto-approve all your user generated content, or set up auto-moderation filters.
* Custom CSS: Style it to fit your brand or site.
* Advanced Analytics: Find out who uses your social feed, and how they interact with it.

Visit [wp.juicer.io](https://wp.juicer.io) for more information

== Installation ==
Download the plugin zip file, unzip it, and upload it to your wordpress site under the /wp-includes/plugins directory.

Sign up via [wp.juicer.io](https://wp.juicer.io) and create a feed for free

One you've done that you can use the shortcode: `[juicer name='YOUR_FEED_NAME']` in any post or page

To get your Juicer feed name:

- Sign into your account on [wp.juicer.io](https://wp.juicer.io)
- Navigate to [juicer.io/feeds](https://www.juicer.io/feeds)
- Click "Edit" on the feed you wish to embed
- You should be taken to a url like https://www.juicer.io/feeds/juicer
- The 'juicer' portion of the url is your feed name.
- To use a shortcode for the embed feed try `[juicer name='juicer']`
- Make sure you replace the `name` above with your feeds name.

Alternatively, you can add the feed to your template directly if you like using PHP. Here's an example: `<?php juicer_feed('name=juicer'); ?>`

= Advanced Usage =

There are a few more parameters you can add to your shortcode / php function that will allow you to limit the number of posts that show up:

`per`is the number of posts you want to show up on a page. Default is 100

`pages` is the number of times you want the feed to add more posts as you scroll (This is known as infinite scroll). By default there is no limit to the number of pages, it will keep going until you've seen all the posts in your feed. If you only want it to add more posts once as you scroll, set this to "2" for example.

So if you wanted your feed to only ever display 15 posts you should do something like this:

`[juicer name='YOUR_FEED_NAME' per='15' pages='1']`

or

`<?php juicer_feed('name=juicer&per=15&pages=1'); ?>`

This will show 15 posts, and ensure that your feed doesn't load any posts beyond the first page.

== Frequently Asked Questions ==

= What is Juicer? =
[Juicer](https://wp.juicer.io) is a service that allows you to create an embeddable feed of all your social media accounts. It's great for increasing brand awareness and engagement and for providing fresh and interesting content for your website with very little work. It auto updates every day, pulling in any new posts, so your feed will always be fresh with your latest social media posts.

= How much does it cost? =
Juicer is free forever. No really! There is a paid account that gives you added features like adding more social media accounts, creating multiple feeds and getting detailed social analytics. But if you just want a feed for your website, it's free forever!

= I only want a few posts showing up, not a huge feed! =
Not a problem! There's a few different ways we can handle this:

**Use our widget:** Log on to your [Juicer account](https://wp.juicer.io) and click on "Edit" for your feed. Then click on "Feed Settings" and change your "Feed Style" to "Widget". This specific style shows just a single post at a time, and slides through them. It's simple and beautiful and perfect for putting in a sidebar or a footer, without taking up as much room as a normal juicer feed.

**Limit the number of posts:** If you want to use a normal Juicer feed, but you don't want it to be super long there are some additional attributes you can pass into the short code or function `per` and `pages`:

`per` is the number of posts you want to show up on a page. Default is 100

`pages` is the number of times you want the feed to add more posts as you scroll (This is known as infinite scroll). By default there is no limit to the number of pages, it will keep going until you've seen all the posts in your feed. If you only want it to add more posts once as you scroll, set this to "2" for example.

So if you wanted your feed to only ever display 15 posts you should do something like this:

`[juicer name='YOUR_FEED_NAME' per='15' pages='1']`

or

`<?php juicer_feed('name=juicer&per=15&pages=1'); ?>`

This will show 15 posts, and ensure that your feed doesn't load any posts beyond the first page.

Make sense? If not, [Contact Us](https://wp.juicer.io) and we'll help you out.

= It's not working for me! =
Sorry to hear that! Give us a shout on our [Contact Page](https://wp.juicer.io) and we'll help you out!

Make sure that if your site has jQuery it is using at least version 1.7

Make sure that all Javascript errors are resolved.

== Screenshots ==
1. An example Juicer Feed using a provided template
2. A Juicer feed with custom CSS
3. The Juicer Dashboard Edit with all the functionality you are able to use.
4. A Juicer feed aggregating YouTube and Instagram
5. A Juicer feed embedded in a hero slider
6. Another Juicer feed with custom CSS


== Changelog ==
= 1.9.3 =
* Plugin behaviour is unchanged.

= 1.9.2 =
* Plugin behaviour is unchanged.

= 1.9.1 =
* Plugin behaviour is unchanged.

= 1.9 =
* Compatibility with 1.9

= 1.8 =
* Make it so if people enter data- attributes in shortcode they will still work.

= 1.7.2 =
* Fixing closing </ul> tag on paid accounts

= 1.7.1 =
* Check for existence of key in args array

= 1.7 =
* Don't show Juicer Branding for paid users

= 1.6.1 =
* Map attributes better, clean up code, support older versions of php

= 1.6 =
* Dynamically generating <ul> based on passed in attributes.

= 1.5 =
* Adding "after" callback

= 1.4.1 =
* Fixing bug with infinite scroll

= 1.4 =
* Making sure shortcode returns at proper place in page.

= 1.3.1 =
* Bug fix

= 1.3 =
* Making sure Juicer Scripts get called at the top of the head

= 1.2 =
* No longer need to specify number of columns. Instead control this in your [Juicer](https://wp.juicer.io) feed editor.

= 1.1.2 =
* Embed js no longer includes jQuery, instead it is enqueued into the theme by wordpress.

= 1.1.1 =
* Fixing bug in juicer_feed php function

= 1.1 =
* Updating default feed

= 1.0 =
* Initial Version

== Upgrade Notice ==
No problems should be encountered when upgrading.
