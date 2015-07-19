#author Varun Bawa
#for queries realted to generic quiz just drop a mail at varunbawa62ak@gmail.com
#Terminology
	DB->Database
	dt->date-time

*universal objects
->UI base-design via materializecss link:http://www.materializecss.com/
->Header and Footer Remains the same throughout the quiz
 
*config.php
->Connects to DB named genericquiz and make it accessible via scripts
*index.php
->includes config.php
->Fetches quizzes from DB from table quizzes and displays it indexed by quiz_no.
->Each quiz is displayed in a card class. Reference:http://www.materializecss.com/
->Card reveal i.e. the sub part includes Participate, Ranking, Time(via tool-tip) and Info which links to pagelink?name='quiz_name'
->Each link redirects to corresponding quiz correctly
->Participate displays questions where table-name=quiz_name
->Ranking is done from table where table-name=quiz_name_score
->Information will link to the poster of Event which will be stored in DB
*create-quiz
->First step is to login
->Field Required are: CSI-IS , Name, E-mail id, Password
->Fisrtly all the CSI Members have to register online(all of them) where info is stored in table 'users'.
->The user who wants to create quiz will generate a request to Event-Head via email or any other means of communication.
->Then the DB Admin will add that user to loginad table and setting the permission on.
->Then that particular user can create a quiz by logging in at 'authtocreate.php'
->After that the User have to enter the quizname and organizer which will be displayed.
->After that a simle process in which user will add question and providing MCQ option if required or None and then the correct answer
->After creating quiz successfully user can edit/add and delete questions if required
->After completing this process and 100% accuracy the user will generate request to Event-Head.
*Checking the quiz
->After generating the request to Event-Head.
->Event-Head will login to his personalized portal i.e. 'request.php'
->After filling the form successfully which includes quiz name, organizer name, Start dt, End dt.
->This will make entry to the table quizzes after which the quiz will be live and will be displayed automatically to index.php
*Participating
->When user clicks on a participate link corresonding to a quiz the quiz will start and if is not active i.e. the start dt has passed or not yet come it'll show the start and end dt.
->When quiz starts link is as follows "start-quiz.php?name='quiz-name'"
->GET variable will connect to corresponding DB and fetches question and also connets to score table of that quiz
->Correct answer increases the score for that user and wrong ans adds 0 to current score
*Ranking
->Redirect link is as follows "result.php?name='quiz-name'".
->connets to DB to table 'quiz_name_score'
->Displays result and Ranking accordingly.