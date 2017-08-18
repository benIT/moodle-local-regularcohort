# Moodle regularcohort local plugin

## Installation

Place this repo in the `local` folder of your Moodle installation and named it `regularcohort`. 

## Purpose

I design this plugin to solve the following situation: 

*On Moodle, how can I restrict self-enroll for critical courses for some users.*

[Here is the discussion about this situation on the Moodle forum.](https://moodle.org/mod/forum/discuss.php?d=354241)

## How does it work?
This plugin is designed to add newly users to a given cohort.

It works with 2 cohorts:
- a cohort for regular users
- a cohort for exceptional users

You must set up  this 2 cohorts to get the plugin active.

**You can then restrict course self enrolment to the 'regular cohort' users.**

## What's inside?

 - A listener to the `core\event\user_created`, `core\event\user_updated`, `core\event\user_loggedin` events. (There's no need to listen to `core\event\user_deleted`. Deleted users are removed from cohorts by MOODLE core.)
 - A web page that will allow to sync cohort with users
 - A cli script that will allow to sync cohort with users: 
 
        php cli/synchronize.php 
        
## Documentation

- [Detailed fr doc](doc/fr/usage.md)