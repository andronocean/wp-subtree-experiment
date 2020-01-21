# Git Subtree experiment

Goal: to understand what happens when using git subtree to import a "dependency" (not under my control) repo, edit it extensively, push those changes to my own origin, and later pull down upstream changes from the dependency's repo and merge those in as desired.

This will be helpful when working on a Bedrock Wordpress project with a custom theme created from a starter (eg WP Rig). While the theme code is included in the whole site repo (for dev & deployment simplicity), I may want to merge upstream changes to the starter theme, if they fit in with customizations and the site goals.

Following [this guide](https://www.atlassian.com/git/tutorials/git-subtree) to subtree.

Paths & files in this repo are selectively pulled from [Bedrock](https://github.com/roots/bedrock).

## Walkthrough

Add the theme repo as a remote:

 `git remote add -f theme-upstream git@github.com:andronocean/oakville-college.git`

There'll be a `warning: no common commits`, which makes sense.

Then, add the subtree:

`git subtree add --prefix=web/app/themes/oakville-college theme-upstream master --squash`

- `--prefix` is the subdirectory into which the subtree repo will be cloned.
- `theme-upstream master` tells git to grab the "master" branch from the remote.
- `--squash` tells git to create a single commit adding everything, instead of importing the remote's entire history (much tidier!)

(We actually get two commits out of this: the first is a squash, the second handles the merge.)