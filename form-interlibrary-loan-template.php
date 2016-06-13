<?php
/**
Template Name: ILL Request Form
 */
remove_filter('the_content', 'wpautop'); // Keeps WP from adding the annoying <p> and <br /> tags to content

?>

<?php

	//If page loaded from EBSCO Discovery Service ILL request
	if(isset($_GET['sendto'])) {
		if (strlen(trim($_GET['ti'])) > 0)
			$article_title = trim($_GET['ti']);
		else $article_title = "N/A";
		if (strlen(trim($_GET['au'])) > 0)
			$article_author = trim($_GET['au']);
		else $article_author = "N/A";
		if (strlen(trim($_GET['JN'])) > 0)
			$article_journal = trim($_GET['JN']);
		else $article_journal = "N/A";
		if (strlen(trim($_GET['Dt'])) > 0)
			$journal_date = trim($_GET['Dt']);
		else $journal_date = "N/A";
		$journal_volume = trim($_GET['vi']);
		$journal_issue = trim($_GET['ip']);
		$article_pages = trim($_GET['pg']);
		$issn = trim($_GET['IS']);
		$isbn = trim($_GET['IB']);
		$article_db = trim($_GET['db']);
		$item_number = trim($_GET['an']);
	}

	//If the form is submitted
	if(isset($_POST['submit'])) {
	
	//Check the honeypot
		if(trim($_POST['laylah']) !== '') {
			$honeypotError = 'You may not be human, please try again.';
			$hasError = true;
		}
	//Check to make sure that the firstname field is not empty
		if(trim($_POST['patron_firstname']) === '') {
			$firstNameError = 'You must enter your first name.';
			$hasError = true;
		} else {
			$patron_firstname = trim($_POST['patron_firstname']);
		}
	//Check to make sure that the lastname field is not empty
		if(trim($_POST['patron_lastname']) === '') {
			$lastNameError = 'You must enter your last name.';
			$hasError = true;
		} else {
			$patron_lastname = trim($_POST['patron_lastname']);
		}	
	//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['patron_email']) === '') {
			$emailError = 'You must enter your email address.';
			$hasError = true;
		} else if (!eregi("^[a-z0-9._%-]*@.*milligan\.edu$", strtolower(trim($_POST['patron_email'])))) {
			$emailError = 'You must enter a valid Milligan email address.';
			$hasError = true;
		} else {
			$patron_email = strtolower(trim($_POST['patron_email']));
		}
	// Get phone
		$patron_phone = trim($_POST['patron_phone']);
	//Check to make sure patron type selected
		if(trim($_POST['patron_type']) === '') {
			$patronTypeError = 'You must select a patron type.';
			$hasError = true;
		} else {
			$patron_type = trim($_POST['patron_type']);
		}
	//Check to make sure program selected
		if(trim($_POST['patron_program']) === '') {
			$studyError = 'You must select a program.';
			$hasError = true;
		} else {
			$patron_program = trim($_POST['patron_program']);
		}
	//Check to make sure pickup location selected
		if(trim($_POST['pickup_location']) === '') {
			$pickupError = 'You must select a pickup location.';
			$hasError = true;
		} else {
			$pickup_location = trim($_POST['pickup_location']);
		}
	//Check to make sure that the title field is not empty
		if(trim($_POST['article_title']) === '') {
			$titleError = 'You must enter the title.';
			$hasError = true;
		} else {
			$article_title = trim($_POST['article_title']);
		}
	//Check to make sure that the author field is not empty
		if(trim($_POST['article_auth']) === '') {
			$authorError = 'You must enter an author.';
			$hasError = true;
		} else {
			$article_author = trim($_POST['article_auth']);
		}

	//Check to make sure that the journal field is not empty
		if(trim($_POST['article_journal']) === '') {
			$journalError = 'You must enter the journal title.';
			$hasError = true;
		} else {
			$article_journal = trim($_POST['article_journal']);
		}
	//Check to make sure that the date field is not empty
		if(trim($_POST['journal_date']) === '') {
			$dateError = 'You must enter a publication date.';
			$hasError = true;
		} else {
			$journal_date = trim($_POST['journal_date']);
		}
	//Autofill entered ISSN
		$issn = trim($_POST['issn']);
	//Autofill entered ISSN
		$isbn = trim($_POST['isbn']);
	//Autofill entered Volume
		$journal_volume = trim($_POST['journal_volume']);
	//Autofill entered Issue
		$journal_issue = trim($_POST['journal_issue']);
	//Autofill entered Page Range
		$article_pages = trim($_POST['article_pages']);
	//Added validation structure to messge field, in case it will ever be required
		if(trim($_POST['patron_message']) === '') {
			$patron_message = trim($_POST['patron_message']);
		} else {
			$patron_message = trim($_POST['patron_message']);
		}
		
	//Autofill Hidden values sent from EDS
		$article_db = trim($_POST['db']);
		$item_number = trim($_POST['an']);

		if(!isset($hasError)) {
        // email request to ILL account
        	if ($patron_program == "Graduate - Seminary") {
	    		$emailTo = 'SEArndt@milligan.edu,JMWade@milligan.edu';
        	}
	    	else {
	    		$emailTo = 'mc_ill@milligan.edu';
	    	}
			$subject = 'Interlibrary Loan Request';
			$body = '<h4>ILL Request made ' . date("F j, Y, g:i a") .'</h4>';
				$body .= '<p><strong>First Name: </strong>' . $patron_firstname  . '</p>';
				$body .= '<p><strong>Last Name: </strong>' . $patron_lastname  . '</p>';
				$body .= '<p><strong>Email: </strong>' . $patron_email . '</p>';
				$body .= '<p><strong>Phone: </strong>' . $patron_phone . '</p>';
				$body .= '<p><strong>Patron Type: </strong>' . $patron_type . '</p>';
				$body .= '<p><strong>Program: </strong>' . $patron_program . '</p>';
				$body .= '<p><strong>Pickup Location: </strong>' . $pickup_location . '</p>';
				$body .= '<p><strong>Title: </strong>' . $article_title . '</p>';
				$body .= '<p><strong>Author: </strong>' . $article_author . '</p>';
				$body .= '<p><strong>Source: </strong>' . $article_journal . '</p>';
				$body .= '<p><strong>Date: </strong>' . $journal_date . '</p>';
				$body .= '<p><strong>ISSN: </strong>' . $issn . '</p>';
				$body .= '<p><strong>ISBN: </strong>' . $isbn . '</p>';
				$body .= '<p><strong>Vol: </strong>' . $journal_volume . '</p>';
				$body .= '<p><strong>Issue: </strong>' . $journal_issue . '</p>';
				$body .= '<p><strong>Pages: </strong>' . $article_pages . '</p>';
				$body .= '<p><strong>Special Instructions: </strong></p><p>' . $patron_message . '</p>';
				$body .= '<p><strong>Database: </strong>' . $article_db . '</p>';
				$body .= '<p><strong>Item Number: </strong>' . $item_number . '</p>';
			$headers[] = 'From: ILL Webform <mc_ill@milligan.edu>';
			$headers[] = 'Reply-To: ' . $patron_email;
			$headers[] = 'content-type: text/html';
			wp_mail( $emailTo, $subject, $body, $headers );
         
         // email confirmation to patron
         $emailTo = $patron_email;
         $subject = 'Interlibrary Loan Request Confirmation';
         $headers = '';
         $headers[] = 'From: ILL Webform <mc_ill@milligan.edu>';
			$headers[] = 'Reply-To: mc_ill@milligan.edu';
			$headers[] = 'content-type: text/html';
         wp_mail( $emailTo, $subject, $body, $headers );
			
			$emailSent = true;
			}
	} ?>

<?php get_header(); ?>

		<div id="primary" class="site-content">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('body-text'); ?>>
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</header><!-- .entry-header -->

						<div class="entry-content welshimer-form">
							<?php the_content(); ?>

								<?php if(isset($emailSent) && $emailSent == true): ?>

									<div class="alert success">
										<p>Thank you for your request. Requests are processed within one week of receipt. Average time to receive items are: 5 days for articles; 2 weeks for books. You will be contacted regarding any lending or postage fees above $15 that are assessed before your request is processed. You will be contacted by email to pick up book/AV material. Articles will be emailed to your Milligan College email address.</p>
										<p><a class="submit full"href="<?php the_permalink() ?>">Submit Another Request</a>
										</div>

								<?php else: ?>
									<?php if(isset($hasError)): ?>
									<div class="alert fail">
										<?php if(isset($honeypotError)){echo $honeypotError . '<br />';}?>
										<?php if(isset($firstNameError)){echo $firstNameError . '<br />';}?>
										<?php if(isset($lastNameError)){echo $lastNameError . '<br />';}?>
										<?php if(isset($emailError)){echo $emailError . '<br />';}?>
										<?php if(isset($patronTypeError)){echo $patronTypeError . '<br />';}?>
										<?php if(isset($studyError)){echo $studyError . '<br />';}?>
										<?php if(isset($pickupError)){echo $pickupError . '<br />';}?>
										<?php if(isset($titleError)){echo $titleError . '<br />';}?>
										<?php if(isset($authorError)){echo $authorError . '<br />';}?>
										<?php if(isset($journalError)){echo $journalError . '<br />';}?>
										<?php if(isset($dateError)){echo $dateError . '<br />';}?>
										<?php if(isset($volumeError)){echo $volumeError . '<br />';}?>
										<?php if(isset($issueError)){echo $issueError . '<br />';}?>
										<?php if(isset($pagesError)){echo $pagesError . '<br />';}?>
									</div>
								<?php else: ?>
									<div class="alert info"><p>Please complete all required fields and citation information. If not available, please indicate N/A in the field. Some information may be filled from citation information provided by the database. Complete all contact information including your Milligan College email address and indicate your preferred pickup location for items. Thank you!</p>
									</div>

									<?php endif; ?>
									<!--ILL Form -->
									<form action="<?php the_permalink(); ?>" method="post">
										<h3>Patron Information</h3>
										<p class="form"><label class="label" for="patron_firstname">First Name:* </label><input class="text half<?php if(isset($firstNameError)){echo ' fail';}?>" type="text" id="patron_firstname" name="patron_firstname" value="<?php if(isset($patron_firstname)){echo $patron_firstname;} ?>"/></p>
										<p class="form"><label class="label" for="patron_lastname">Last Name:* </label><input class="text half<?php if(isset($lastNameError)){echo ' fail';}?>" type="text" id="patron_lastname" name="patron_lastname" value="<?php if(isset($patron_lastname)){echo $patron_lastname;} ?>"/></p>
										<p class="form"><label class="label" for="patron_email">Milligan Email:* </label><input class="text three-fourths<?php if(isset($emailError)){echo ' fail';}?>" type="text" id="patron_email" name="patron_email" value="<?php if(isset($patron_email)){echo $patron_email;} ?>" /></p>
										<p class="form"><label class="label" for="patron_phone">Phone: </label><input class="text half" type="text" id="patron_phone" name="patron_phone" value="<?php if (isset($patron_phone)){echo $patron_phone;} ?>" /></p>
										<p class="form"><label class="label" for="patron_type">Patron Type:* </label><select class="text half<?php if (isset($patronTypeError)){echo ' fail';}?>" name="patron_type" id="patron_type">
											<option value="">Select...</option>	
											<option value="Faculty/Staff"<?php if($patron_type == 'Faculty/Staff') echo ' selected'; ?>>Faculty/Staff</option>
											<option value="Student"<?php if($patron_type == 'Student') echo ' selected'; ?>>Student</option>
										</select></p>
										<p class="form"><label class="label" for="patron_program">Program:* </label><select class="text three-fourths<?php if (isset($studyError)){echo ' fail';}?>" name="patron_program" id="patron_program">
											<option value="">Select...</option>
											<option value="Undergraduate"<?php if($patron_program == 'Undergraduate') echo ' selected'; ?>>Undergraduate</option>
											<option value="Graduate - Business Administration"<?php if($patron_program == 'Graduate - Business Administration') echo ' selected'; ?>>Graduate - Business Administration</option>
											<option value="Graduate - Counseling"<?php if($patron_program == 'Graduate - Counseling') echo ' selected'; ?>>Graduate - Counseling</option>
											<option value="Graduate - Education"<?php if($patron_program == 'Graduate - Education') echo ' selected'; ?>>Graduate - Education</option>
											<option value="Graduate - Occupational Therapy"<?php if($patron_program == 'Graduate - Occupational Therapy') echo ' selected'; ?>>Graduate - Occupational Therapy</option>
											<option value="Graduate - Seminary"<?php if($patron_program == 'Graduate - Seminary') echo ' selected'; ?>>Graduate - Seminary</option>
										</select></p>
										<p class="form"><label class="label" for="pickup_location" >Pickup Location:* </label><select class="text three-fourths<?php if (isset($pickupError)){echo ' fail';}?>" name="pickup_location" id="pickup_location">
											<option value="">Select...</option>
											<option value="Welshimer Library"<?php if($pickup_location == 'Welshimer Library') echo 'selected'; ?>>Welshimer Library</option>
											<option value="Seminary Library"<?php if($pickup_location == 'Seminary Library') echo 'selected'; ?>>Seminary Library</option>
										</select></p>
										<h3>Requested Item Information</h3>
										<p class="form"><label class="label" for="article_title">Title:* </label><input class="text<?php if(isset($titleError)){echo ' fail';}?>" type="text" id="article_title" name="article_title" value="<?php if(isset($article_title)){echo $article_title;} ?>" /></p>
										<p class="form"><label class="label" for="article_auth">Author:* </label><input class="text<?php if(isset($authorError)){echo ' fail';}?>" type="text" id="article_auth" name="article_auth" value="<?php if(isset($article_author)){echo $article_author;} ?>" /></p>
										<p class="form"><label class="label" for="article_journal">Source:* </label><input class="text<?php if(isset($journalError)){echo ' fail';}?>" type="text" id="article_journal" name="article_journal" value="<?php if(isset($article_journal)){echo $article_journal;} ?>" /></p>
										<p class="laylah"><label for="laylah">Required</label><input type="text" id="laylah" name="laylah" tabindex="999" /></p>
										<p class="form"><label class="label" for="journal_date">Publication Date:* </label><input class="text half<?php if(isset($dateError)){echo ' fail';}?>" type="text" id="journal_date" name="journal_date" value="<?php if(isset($journal_date)){echo $journal_date;} ?>" /></p>
										<p class="form"><label class="label" for="issn">ISSN: </label><input class="text half" type="text" id="issn" name="issn" value="<?php if(isset($issn)){echo $issn;} ?>" /></p>
										<p class="form"><label class="label" for="isbn">ISBN: </label><input class="text half" type="text" id="isbn" name="isbn" value="<?php if(isset($isbn)){echo $isbn;} ?>" /></p>
										<p class="form"><label class="label" for="journal_volume">Volume: </label><input class="text half<?php if(isset($volumeError)){echo ' fail';}?>" type="text" id="journal_volume" name="journal_volume" value="<?php if(isset($journal_volume)){echo $journal_volume;} ?>" /></p>
										<p class="form"><label class="label" for="journal_issue">Issue/Number: </label><input class="text half<?php if(isset($issueError)){echo ' fail';}?>" type="text" id="journal_issue" name="journal_issue" value="<?php if(isset($journal_issue)){echo $journal_issue;} ?>" /></p>
										<p class="form"><label class="label" for="article_pages">Inclusive Pages: </label><input class="text half<?php if(isset($pagesError)){echo ' fail';}?>" type="text" id="article_pages" name="article_pages" value="<?php if(isset($article_pages)){echo $article_pages;} ?>" /></p>
										<p class="form"><label class="label" for="patron_message">Special Instructions: </label><textarea class="textarea" id="patron_message" name="patron_message" ><?php if(isset($patron_message)){echo $patron_message;} ?></textarea></p>
										<p class="form"><input class="submit full" type="submit" name="submit" value="Send Request" ></p>
									</form>
								<?php endif; ?>



							<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'welshimer2013' ), 'after' => '</div>' ) ); ?>
							<?php edit_post_link( __( 'Edit', 'welshimer2013' ), '<div><span class="edit-link">', '</span></div>' ); ?>
						</div><!-- .entry-content -->
					</article><!-- #post-<?php the_ID(); ?> -->
				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>