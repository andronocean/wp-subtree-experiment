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

### Make project changes

We can edit the theme files and commit changes on our main, parent repo.

Note that it's a good idea to put changes inside and outside the subtree into separate commits (we'll see why...)

### Pull in upstream changes

If the upstream theme gets updated and we want to include those changes in our project, we can do so:

`git subtree pull --prefix=web/app/themes/oakville-college theme-upstream master --squash`

The options are the same as wiht `subtree add`.

(It's safest to do this on a special branch, since merging could be a complicated affair.)

### Splitting out the subtree

Let's say we find a new use for our theme and want to put it in its own repository. We can split out the subtree edit history into its own project.

To start, we'll make a new repo wherever we want the theme-on-its-own to live. Note that this *must* be a bare repo, or it won't work: 

`git init --bare`

In the main monorepo directory, we run a split:

`git subtree split --prefix=web/app/themes/oakville-college --annotate="(split)" -b split`

This creates a new branch called "split". We can then push this branch to the new, empty repo:

`git push /full/path/to/the/new/repo split:master`

Since it's a bare repo, we can't `cd` to it and `ls` to view contents. `git log` inside the repo directory works, however, and will show that *only* the commits touching the original subtree are included. (This is why separating main and subtree commits is smart.)


### Notes and more resources
1. [Full explanation and documentation for git subtree](https://git.kernel.org/pub/scm/git/git.git/plain/contrib/subtree/git-subtree.txt)
2. [Comparison of subtrees and submodules](https://codewinsarguments.co/2016/05/01/git-submodules-vs-git-subtrees/)
3. Don't confuse `git subtree` with the [subtree merge strategy](https://git-scm.com/book/en/v2/Git-Tools-Advanced-Merging#_subtree_merge). See note 1 for differences.
