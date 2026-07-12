# Project_01

# Global Food Discovery

## Team Members

- MaKayla Davis
- Cinthia Mariana Ochoa Torre


# Project Overview

Global Food Discovery is a PHP web application that we created to help people discover foods from different countries while learning more about different cultures and cuisines. We wanted to build something that could help both adventurous food lovers and picky eaters by making it easier to understand what a dish tastes like before trying it. Instead of only showing pictures of food, our website gives users information about ingredients, flavor profiles, allergens, dietary restrictions, and where each dish comes from.

One of our biggest goals was to make exploring different foods simple and interactive. Users can search for dishes using keywords, browse foods based on different flavor profiles, view detailed information about each dish, and take a taste quiz to receive personalized recommendations. Since all of the information comes from one shared PHP data file, every page stays connected and updates consistently throughout the website.

# Project Goals

When planning this project, we wanted to create a website that was both informative and easy to use. We focused on building a responsive application that could work well on desktops, tablets, and mobile devices while also practicing the PHP concepts we've learned throughout the course.

Some of our main goals included creating dynamic pages instead of hardcoding information, organizing our data using arrays, making the website responsive, improving accessibility, and collaborating through GitHub while keeping our work organized.


# Features

Our website includes several different features that work together to give users a complete experience.

The home page welcomes users with a hero section, a search bar, and featured dishes that are automatically displayed using a PHP foreach loop. Since the dishes come from a shared array, adding new dishes automatically updates the homepage without changing the page itself.

The Explore page allows users to search for dishes by keywords and filter results using flavor profiles and dietary preferences. Instead of scrolling through every dish, users can quickly find foods that match what they're looking for.

Each dish has its own detail page that displays a description, ingredients, flavor tags, allergens, dietary information, country of origin, and an image. This information is loaded dynamically based on the dish ID, which keeps the project organized and avoids creating separate pages for every dish.

The Taste Quiz allows users to answer questions about their food preferences. Their answers are validated and saved using PHP sessions so their recommendations can be displayed later on the profile page.

The Profile page displays the user's saved preferences along with recommended dishes that best match their responses from the quiz.


# Technologies Utilized

Throughout this project we utilized:

- PHP
- HTML5
- CSS3
- Git
- GitHub
- Visual Studio Code

We also utilized PHP features like associative arrays, foreach loops, include statements, GET and POST requests, sessions, functions, conditionals, and input validation to make the website dynamic instead of relying on static pages.


# Responsive Design

Making the website responsive was one of the biggest parts of this project. We wanted users to have the same experience whether they were using a computer, tablet, or phone.

To accomplish this, we utilized CSS Grid, flexible layouts, media queries, relative units like rem and percentages, CSS custom properties, and responsive images. Every page adjusts to different screen sizes while keeping the content organized and easy to read.


# Accessibility

Accessibility was also something we kept in mind while building our website. We utilized semantic HTML elements to improve the structure of each page, added descriptive alt text for images, used proper heading order, and made sure forms included labels for better usability. We also focused on maintaining readable font sizes and color contrast so the content would be easier for everyone to navigate.

# Installation

1. Clone the repository from GitHub.
2. Open the project in Visual Studio Code.
3. Run the project using a local PHP server such as XAMPP, MAMP, or PHP's built-in server.
4. Open the local server in your web browser.
5. Explore the website by searching dishes, viewing details, and taking the taste quiz.


# Folder Structure

```text
css/
data/
images/
includes/

index.php
explore.php
detail.php
quiz.php
profile.php
README.md
```

# Version Control

We utilized Git and GitHub throughout development to keep our work organized and make collaboration easier. Before starting new work, we pulled the latest changes from the repository, completed our assigned tasks, committed our changes with meaningful commit messages, and pushed everything back to GitHub. This helped us keep track of updates and made it easier to combine both of our contributions into one project.

# AI Usage Disclosure

ChatGPT was utilized throughout this project as a learning and development tool. It helped explain PHP concepts, troubleshoot errors, organize project planning, improve documentation, and assist with portions of the implementation. Every suggestion was reviewed, tested, and edited when needed before being added to the final project. We made sure we understood the code that was utilized and verified that every feature met the project requirements before submission.

---

# Reflection

This project gave us a better understanding of how PHP can be utilized to build dynamic web applications. We learned how to organize information using shared arrays, connect multiple pages together, process user input, work with sessions, and create responsive layouts that work across different devices. We also gained more experience using GitHub to collaborate as a team, which made it easier to divide responsibilities and keep the project organized throughout development.

---

# Authors

MaKayla Davis & Cinthia Mariana Ochoa Torre

---

### Submission Links
- **Video Walkthrough:** [Project 1 Video Walkthrough](https://drive.google.com/drive/home?dmr=1&ec=wgc-drive-globalnav-goto)
- **GitHub Repository:** [Repo URL Link](https://github.com/CinthiaOchoaTorre/Project_01)