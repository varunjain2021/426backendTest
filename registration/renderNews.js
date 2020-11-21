export async function generateNewsFeed(e) {
    
    e.preventDefault();
    
    const $root = $('#newsFeed')
    $root.empty();

    const myKey = "480cae414ceb43cbab94d9ab001bd7ec"
    //const myKey = "04y3az07rff4nmq5r354joldi"

    //let ticker = $(`p[class="control"][name="stockType"]`).text();
    let ticker = document.getElementById('ticker').value;
    console.log(ticker)

    const feed = await axios({

        method: 'get',
        //url: `http://api.datanews.io/v1/headlines`,
        //headers: {
        //    Authorization: `${myKey}`,
        //},
        url: 'https://newsapi.org/v2/everything?q='+ticker+'&sortBy=relevancy&apiKey='+myKey,
        withCreditals: true
    });
    console.log(feed);
    let posts = `<div id=articles>`;
    for(let i = 0; i < 20; i++) {
        if(feed.data.articles[i]["url"]!=null && feed.data.articles[i]["title"]!=null && feed.data.articles[i]["urlToImage"]!=null && feed.data.articles[i]["description"]!= null && feed.data.articles[i]["author"] != null) {
        posts += `  <div class="box"> 
                    <div class="column">
                        <h1 class="title"><a href="${feed.data.articles[i]["url"]}" target="_blank">${feed.data.articles[i]["title"]}</a></h1>
                        <div class="columns is-mobile">
                            <div class="column">
                                <figure class="image">
                                    <img src="${feed.data.articles[i]["urlToImage"]}">
                                </figure>
                                <br>
                            </div>
                            <div class="column">
                                <p>${feed.data.articles[i]["description"]}</p>
                                <br>
                                <p>Author: ${feed.data.articles[i]["author"]}</p>
                            </div>
                        </div>
                        <form method="get" name="form2" action="home.php"> 
                        <button name="save" type="submit"  id="save" value="${feed.data.articles[i]["url"]}">Save Article <span class="icon is-medium"><i class="fa fa-heart"></i></span></button>
                        </form>
                        </div>
                    </div>`;   
        } 
    }
    posts += `</div>`;
    $root.append(posts);
}



export const renderSite = function() {
    const $root = $('#newsFeed');
    $(document).on('click', '#generate', generateNewsFeed);

}

$(function() {
    renderSite();
});