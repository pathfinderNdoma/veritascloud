<div class="col-lg-5 col-md-8">
    <div class="form">
      <form name="form" action="{{route('store.messages')}}" method="POST"  enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
        </div>
        <div class="form-group mt-3">
          <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
        </div>
        <div class="form-group mt-3">
          <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
        </div>
        <div class="form-group mt-3">
          <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
        </div>
      </br>
      @include('inc.messages')
        {{-- <div class="my-3">
          <div class="loading">Loading</div>
          <div class="error-message"></div>
          <div class="sent-message">Your message has been sent. Thank you!</div>
        </div> --}}
        <div class="text-center"><button type="submit" id="send_message" class="btn btn-success" style="background-color:#198754;">Send Message</button></div>
      </form>
    </div>
  </div> 