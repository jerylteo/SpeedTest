let tagList = [];
$(document).ready(() => {
    $(".fakebox").click(() => {
        $(".textbox").focus();
    })

    //need improve this algo. a bit stupid.
    $("html").click((e) => {
        if ($(e.target).hasClass("textbox")
            || $(e.target).hasClass("dropdown")
            || $(e.target).hasClass("tagRow")
            || $(e.target).hasClass("tag")
            || $(e.target).hasClass("selectedTag")
            || $(e.target).hasClass("cross")
        ) {
            $(".dropdown").show();
        } else {
            $(".dropdown").hide();
        }
    })

    $.ajax({
        url: "./taglist.json",
        method: "get"
    })
        .done(data => {
            tagList = data;
            data.forEach(tag => {
                createNewTag(tag);
            })
        })

    $(".textbox").keyup((e) => {
        let text = $(".textbox").val();
        $(".tagRow").show();
        $(".createNewTag").remove();

        if (text != "") {
            //assume press enter for new tag. it is unclear from the gif
            if (e.key == "Enter") {
                let newTag = { id: tagList.length + 1, name: text, color: "purple" }
                tagList.push(newTag);
                createNewTag(newTag);
                createSelectedTag(newTag);
                $(".textbox").val("");
                $(".tagRow").show();
            } else {
                let unmatchedTags = tagList.filter(t => {
                    return !t.name.toLowerCase().includes(text.toLowerCase());
                })
                unmatchedTags.forEach(function (e) {
                    $(`#${e.id}`).parent().hide();
                })
                $(".dropdown").append(`
                    <div class="tagRow createNewTag">Create
                        <div class="tag" style="background-color:purple">${text}</div>
                    </div>
                `)
            }
        }
    })
})


function createNewTag(tag) {
    let element = $(`
    <div class="tagRow">
        <div class="tag" id=${tag.id} style="background-color:${tag.color}">${tag.name}</div>
    </div>
    `);
    $(".dropdown").append(element);

    $(element).click((e) => {
        let id = $(e.target).attr("id");
        let tag = tagList.find(t => {
            return t.id == id;
        })
        createSelectedTag(tag);
    })
}

function createSelectedTag(tag) {
    let newTagElem = 
    `<div class="selectedTag" style="background-color:${tag.color}">
        ${tag.name}<span class="cross">X</span>
    </div>`;
    $(newTagElem).insertBefore($(".textbox"));
    $(".cross").click((e) => {
        $(e.target.parentNode).remove();
    })
}