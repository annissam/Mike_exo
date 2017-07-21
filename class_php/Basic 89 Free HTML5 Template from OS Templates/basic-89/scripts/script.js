$(function() {

    let index = 0;
    let dataJson;
    let tableauImage = ["https://vh1.mtvnimages.com/uri/mgid:file:gsp:entertainment-assets:/vh1/shows/vh1-shows-hub/black-ink-crew-5.jpg?width=640&height=360&crop=true", "http://353online.com/wp-content/uploads/2015/09/BIC1-WOTSN.jpg", "https://img-www.tf-cdn.com/show/2/black-ink-crew.jpeg?_v=20170119224217&fit=crop&crop=faces%20top&w=880&h=440"];

    setInterval(function() {

        $("#image_slide").attr("src", tableauImage[index]);
        $("#image_slide").css("height", "100%");

        index++;

        if (index == tableauImage.length)
            index = 0;
    }, 3000)


    $(".more").click(function(e) {
        e.preventDefault();

        $(this).children().text()!="<<Less"){
            $$(this).children().text!="<<Less")
        };

        let text = $(this).prev().text();
        console.log(text);
        for (let a = 0; a < 4; a++) {
            if (text = dataJson[a].body.substring(0, 20) + " ...") {
                $(this).prev().text(dataJson[a].body);
                break;
            }
        }

        // let text = $(this).prev().text();
        // $(this).prev().append("eouhfzjhfmrh mfrh jrh jhg kjhlkjg rkgjr kjrgkjreglkjre lkhjg lkjrh lkjrh lkerjhh rekjh krejhg krjheg kjrhegkjreh kljrhel kjhrel kh");
    });

    $("#slider").click(function() {
        $("#image_slide").attr("src", "https://aboutme.imgix.net/background/users/m/i/k/mikesylvestre_1466689587_94.jpg?q=80&dpr=1&auto=format&fit=max&w=1024&h=512&rect=0,122,1024,512");
    });

    $(".one_third").click(function() {
        /* Execice 1
        let id = $(this).children().attr("id");
        let source;

        if (id == "image1")
            source = "http://totoofficial.com/splash/images/toto-logo.jpg";
        else if (id == "image2")
            source = "http://www.ilovegenerator.com/large/jtm-love-toto-132082952652.png";
        else
            source = "http://www.lmpt.univ-tours.fr/~manu/pages_perso/toto.jpg";

        $(this).children().attr("src", source);*/

        /* Execice 2 */
        let omar = $("#image1").attr("src");
        $("#image1").attr("src", $("#image3").attr("src"));
        $("#image3").attr("src", $("#image2").attr("src"));
        $("#image2").attr("src", omar);
    });








    $.ajax({
            url: "https://jsonplaceholder.typicode.com/posts",
            method: "GET"
        })
        .done(function(data) {
            $(".one_quarter > strong").eq(0).text(data[0].title);
            $(".one_quarter > strong").eq(1).text(data[1].title);
            $(".one_quarter > strong").eq(2).text(data[2].title);
            $(".one_quarter > strong").eq(3).text(data[3].title);
            $(".description").eq(0).text(data[0].body.substring(0, 20) + " ...");
            $(".description").eq(1).text(data[1].body.substring(0, 20) + " ...");
            $(".description").eq(2).text(data[2].body.substring(0, 20) + " ...");
            $(".description").eq(3).text(data[3].body.substring(0, 20) + " ...");
            dataJson = data;
            $("more>a").eq(0).text("Read more>>");
            $("more>a").eq(1).text("Read more>>");
            $("more>a").eq(2).text("Read more>>");
            $("more>a").eq(3).text("Read more>>");
        })

}
initText()

})
