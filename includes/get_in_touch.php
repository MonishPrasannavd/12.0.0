<form class="contact-form" id="contact-form" action="sendemail.php" method="post" novalidate="novalidate">
								<div class="row">
									<div class="form-group col-lg-6">
										<label
											class="form-label font-weight-bold text-uppercase text-dark mb-1 text-2">Your
											Name *</label>
										<input type="text" value="" placeholder="Enter your name"
											data-msg-required="Please enter your name." maxlength="100"
											class="form-control text-3 h-auto border-width-2 border-radius-2 border-color-grey-200 py-2"
											name="name" required>
									</div>
									<div class="form-group col-lg-6">
										<label
											class="form-label font-weight-bold text-uppercase text-dark mb-1 text-2">Email
											Address</label>
										<input type="email" value="" placeholder="Enter your e-mail address"
											data-msg-required="Please enter your email address."
											data-msg-email="Please enter a valid email address." maxlength="100"
											class="form-control text-3 h-auto border-width-2 border-radius-2 border-color-grey-200 py-2"
											name="email" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-lg-6">
										<label
											class="form-label font-weight-bold text-uppercase text-dark mb-1 text-2">Phone
											Number</label>
										<input type="tel" value="" placeholder="Enter your phone number"
											data-msg-required="Please enter your Mobile Number." maxlength="10"
											class="form-control text-3 h-auto border-width-2 border-radius-2 border-color-grey-200 py-2"
											name="phone" required>
									</div>
									<div class="form-group col-lg-6">
										<label
											class="form-label font-weight-bold text-uppercase text-dark mb-1 text-2">Company
											Name</label>
										<input type="text" value="" placeholder="Enter your company name"
											data-msg-required="Please enter your company name."
											class="form-control text-3 h-auto border-width-2 border-radius-2 border-color-grey-200 py-2"
											name="company" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-lg-6">
										<label
											class="form-label font-weight-bold text-uppercase text-dark mb-1 text-2">Industry</label>
										<input type="text" value="" placeholder="Enter your industry name"
											data-msg-required="Please enter your industry name."
											class="form-control text-3 h-auto border-width-2 border-radius-2 border-color-grey-200 py-2"
											name="industry" required>
									</div>
									<div class="form-group col-lg-6">
										<label
											class="form-label font-weight-bold text-uppercase text-dark mb-1 text-2">Annual
											Revenue</label>
										<input type="text" value="" placeholder="Enter your annual revenue"
											data-msg-required="Please enter your annual revenue."
											class="form-control text-3 h-auto border-width-2 border-radius-2 border-color-grey-200 py-2"
											name="revenue" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col">
										<label
											class="form-label font-weight-bold text-uppercase text-dark mb-1 text-2">Additional
											Information</label>
										<textarea maxlength="5000"
											placeholder="Enter Additional Information or Questions" rows="8"
											class="form-control text-3 h-auto border-width-2 border-radius-2 border-color-grey-200 py-2"
											name="message"></textarea>
									</div>
								</div>
								<div class="row">
									<div class="form-group col">
										<button type="submit"
											class="btn btn-rounded btn-dark box-shadow-7 font-weight-medium btn-swap-1"
											data-clone-element="1" id="submit-btn">
											<span>Submit <i
													class="fa-solid fa-arrow-right ms-2 p-relative left-10"></i></span>
										</button>
									</div>
								</div>
								<div class="contact-form-success alert alert-success d-none mt-3">
									<strong>Success!</strong> Your message has been sent to us.
								</div>
								<div class="contact-form-error alert alert-danger d-none mt-3">
									<strong>Error!</strong> There was an error sending your message.
								</div>
								<div class="mail-error-message alert alert-danger d-none mt-3" role="alert">
								</div>
							</form>