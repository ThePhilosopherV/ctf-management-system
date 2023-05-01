$(document).ready(function() {
    $("#challenges-tab").click(function() {
      $("#challenges-tab").removeClass("nav-link");
      $("#challenges-tab").addClass("nav-link active");
  
      $("#rankings-tab").removeClass("nav-link active");
      $("#rankings-tab").addClass("nav-link");
  
      $("#overview-tab").removeClass("nav-link active");
      $("#overview-tab").addClass("nav-link");
  
      $("#challenges").removeClass("tab-pane fade");
      $("#challenges").addClass("tab-pane fade show active");
  
      $("#rankings").removeClass("tab-pane fade show active");
      $("#rankings").addClass("tab-pane fade");
  
      $("#overview").removeClass("tab-pane fade show active");
      $("#overview").addClass("tab-pane fade");
      
    });
  
    $("#rankings-tab").click(function() {
      $("#rankings-tab").removeClass("nav-link");
      $("#rankings-tab").addClass("nav-link active");
  
      $("#challenges-tab").removeClass("nav-link active");
      $("#challenges-tab").addClass("nav-link");
  
      $("#overview-tab").removeClass("nav-link active");
      $("#overview-tab").addClass("nav-link");
  
      $("#rankings").removeClass("tab-pane fade");
      $("#rankings").addClass("tab-pane fade show active");
  
      $("#challenges").removeClass("tab-pane fade show active");
      $("#challenges").addClass("tab-pane fade");
  
      $("#overview").removeClass("tab-pane fade show active");
      $("#overview").addClass("tab-pane fade");
     
    });
    $("#overview-tab").click(function() {
  
      $("#overview-tab").removeClass("nav-link");
      $("#overview-tab").addClass("nav-link active");
  
      $("#rankings-tab").removeClass("nav-link active");
      $("#rankings-tab").addClass("nav-link");
  
      $("#challenges-tab").removeClass("nav-link active");
      $("#challenges-tab").addClass("nav-link");
  
      $("#overview").removeClass("tab-pane fade");
      $("#overview").addClass("tab-pane fade show active");
  
      $("#rankings").removeClass("tab-pane fade show active");
      $("#rankings").addClass("tab-pane fade");
  
      $("#challenges").removeClass("tab-pane fade show active");
      $("#challenges").addClass("tab-pane fade");
    });
  
  });