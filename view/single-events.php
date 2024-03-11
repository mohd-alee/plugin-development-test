<?php get_header(); ?>
<style>
    #booking_special_reqs {
        height: 150px;
        resize: none;
    }
</style>
<div class="container">
    <div class="row">
        <?php
        $_ID = get_the_ID();
        $imageURL = get_the_post_thumbnail_url();
        if ($imageURL):
            ?>
            <div class="col-md-12">
                <div class="event-img wrapper">
                    <img src="<?php echo $imageURL; ?>" alt="Event Featured Image" class="img-fluid">
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-12">
            <div class="event-meta mt-4">
                <ul class="d-flex gap-4 list-unstyled meta-listing p-0">
                    <li><b>Event Date:</b>
                        <?php echo get_post_meta($_ID, '_event_date', true); ?>
                    </li>
                    <li><b>Event Location:</b>
                        <?php echo get_post_meta($_ID, '_event_location', true); ?>
                    </li>
                </ul>
            </div>
            <div class="event_details mt-4">
                <h1>
                    <?php echo get_the_title($_ID); ?>
                </h1>
                <p>
                    <?php echo get_the_content($_ID); ?>
                </p>
            </div>
            <hr>
            <div class="event-booking-form wrapper">
                <h4 class="display-4 text-center">Book Now</h4>
                <?php if (is_user_logged_in()): ?>
                    <form method="POST" action="<?php echo plugin_dir_url(__FILE__) . 'submit-booking.php'; ?>">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="booking_name" placeholder="Name"
                                        name="booking_name" required>
                                    <label for="booking_name">Name</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="booking_email"
                                        placeholder="johndoe@example.com" name="booking_email" required>
                                    <label for="booking_email">Email</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="booking_attendees"
                                        placeholder="johndoe@example.com" name="booking_attendees" required>
                                    <label for="booking_attendees">No. of attendees</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea class="form-control" name="booking_special_reqs" id="booking_special_reqs"
                                        cols="30" rows="10" placeholder="Any Special Requests (optional)"></textarea>
                                    <label for="booking_attendees">Any Special Requests (optional)</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-2">
                                <input type="submit" class="btn btn-primary btn-success btn-lg" value="Confirm Booking">
                            </div>
                        </div>
                    </form>
                <?php else: ?>
                    <p class="text-center">You need to login to book this event!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>