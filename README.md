# Git Subtree experiment

Goal: to understand what happens when using git subtree to import a "dependency" (not under my control) repo, edit it extensively, push those changes to my own origin, and later pull down upstream changes from the dependency's repo and merge those in as desired.

This will be helpful when working on a Bedrock Wordpress project with a custom theme created from a starter (eg WP Rig). While the theme code is included in the whole site repo (for dev & deployment simplicity), I may want to merge upstream changes to the starter theme, if they fit in with customizations and the site goals.

Following [this guide](https://www.atlassian.com/git/tutorials/git-subtree) to subtree.

Paths & files in this repo are selectively pulled from [Bedrock](https://github.com/roots/bedrock).

## Walkthrough

Add the theme repo as a remote:

 `git remote add -f theme-upstream git@github.com:andronocean/oakville-college.git`

There'll be a `warning: no common commits`, which makes sense.
