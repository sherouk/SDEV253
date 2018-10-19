# Vagrant Demo

This is a contrived example building a VM with a Vagrantfile, and publish it via git.

By using Vagrant, Virtualbox, and Git, each student gets:

- A portfolio of their achievements while studying a software development class
- Self-service environment provisioning.  No waiting on Information Technology.
- A completely reproducible, ephemeral test instance in which to develop code
- An environment devoid of side effects caused by other students
- A simplified, uniform troubleshooting experience:
  - The username is always `vagrant`
  - The testing URL is always `http://localhost:8080`
  - Students have complete access to their testing machine, meaning they can 
  read server logs, experiment with system software, or do whatever they want.
  - Is the problem too difficult to resolve? Just destroy the VM and run `vagrant up` again.

Bugs in the demo?  Instructors can have students submit pull requests from their own
git repository to the original, or submit their own pull requests for peer review. 

## Prerequisites

Some software must be installed prior to building an environment:

- [git](https://git-scm.com/downloads)
- [virtualbox](https://www.virtualbox.org/)
- [vagrant](https://vagrantup.com/)

## Quick Start

 

```
git clone https://ivytech.githost.com/kkeane1/vagrant-demo.git
cd vagrant-demo
vagrant up
```

Note: The above vagrant up command will trigger Vagrant to download the `ubuntu/bionic` box via the specified URL Vagrant only does this if it detects that the box doesn't already exist on your system.

## Getting Started Guide

After creating your own, [free Github account](https://github.com/join), you will want to 
[fork](https://help.github.com/articles/fork-a-repo/) a copy of this repo to your own account. 

Once you have forked this repository into your own account, you can [clone](https://help.github.com/articles/cloning-a-repository/)
a copy of it to your local machine.

## Student Work

Take a look at the `Vagrantfile`.  Notice that it declares a synchronized folder:

```
config.vm.synced_folder "php-example", "/var/www/html/php-example"
```

When you run `vagrant up`, this folder will be available at http://localhost:8080/php-example.
That's because the local copy of the php-example folder, in this repository, gets synchronized
to /var/www/html/php-example in the VM that Vagrant will start.

What this means is that students could create custom work in their own local folder (let's call
it "work"), test their work at http://localhost:8080/work, and then commit and push their work
to their own Git repositories.  Which leads us to grading.\*

One small note: you can add a git submodule, or add a folder, but a folder may not contain
local files *and* be the target of a git submodule.  In other words, if you expect students
to create or change their own files in a subdirectory, then you'll need to leave that folder
empty.

## Grading

Once a student has completed her work, an instructor simply has to clone her repository to 
his own machine.  For example, let's say three students are taking a course.  The instructor 
could create a grading directory, clone each student's repository into that directory, and
then run `vagrant up`.  The machine should come up, starting a 

```
# Obtain students' work
mkdir ~/grading
cd ~/grading
git clone https://github.com/gswallow/vagrant-demo.git gswallow
git clone https://github.com/msmith/vagrant-demo.git msmith
git clone https://github.com/bsimon/vagrant-demo.git bsimon

# Grade gswallow's work
cd gswallow
vagrant up # test passes
vagrant destroy -f

# Grade msmith's work
cd ../msmith
vagrant up # test passes
vagrant destroy -f

# Grade bsimon's work
cd ../bsimon
vagrant up # test passes
vagrant destroy -f
```

When you're done, there's no reason to keep that cruft around.  You can just remove the `grading`
folder and re-clone a student's work if necessary.

# Further ideas

This demo is contrived.  It uses a basic Ubuntu box, published in the public Vagrant box
catalog, along with some demo code and some tests.  The demonstrated
code is beside the point.  What matters here is the process.

It's entirely possible to create your own Vagrant box using [Packer](https://www.packer.io/).
Coupled with cheap cloud storage like Amazon S3, you can publish your own LAMP stack (or
use someone else's if that suits you) and allow students to download it by making the 
Vagrant box files publicly accessible and obtaining the download link.  Best of all, all of this
is free (or, in the case of Amazon S3, extremely cheap).

