var nodemap, linkmap = d3.map();

function initdata(nm, lm) {
    nodemap = d3.map(nm);

    function datainit(xx) {
        xx.forEach(function(d, i) {
            this.set(i.id, i);
            if (i.id != d) {
                this.remove(d)
            }
        })
    };
    datainit(nodemap);
    initNodeshape(nodemap, lm);
    return {
        nodes: nodemap.values(),
        links: linkmap.values()
    }
};

function initNodeshape(nm, lm) {
    nm.forEach(function(d) {
        fixNode(this.get(d))
    });
    d3.selectAll(lm).each(function(d, i) {
        fixLink(this);
        var tempidstr = (function() {
            if (linkmap.has(this.linkstr[0])) {
                return this.linkstr[0]
            } else if (linkmap.has(this.linkstr[1])) {
                return this.linkstr[1]
            } else {
                return ""
            }
        }).call(this);
        if (tempidstr != "") {
            var n = linkmap.get(tempidstr).linknum;
            this.linkpos = n;
            linkmap.get(tempidstr).linknum = (n + (n < 0 ? -1 : 0)) * -1;
            linkmap.get(tempidstr).linklist.push(this);
            this.flink = linkmap.get(tempidstr)
        } else {
            this.linkpos = 0;
            linkmap.set(this.linkstr[0], {
                id: this.source.id + "_$$_" + this.target.id,
                source: this.source,
                target: this.target,
                defultstyle: {
                    "font-size": 12,
                    "fill": "#999"
                },
                linklist: [this],
                linknum: 1,
                state: 0
            });
            this.flink = linkmap.get(this.linkstr[0]);
            this.source.aboutnode.set(this.target.id, this.target);
            this.target.aboutnode.set(this.source.id, this.source);
            this.source.aboutlink.set(this.linkstr[0], linkmap.get(this.linkstr[0]));
            this.target.aboutlink.set(this.linkstr[0], linkmap.get(this.linkstr[0]))
        }
    })
};
function fixNode(n) {
    n.aboutlink = d3.map();
    n.aboutnode = d3.map();
    n.entitystate = {
        "isselect": 0,
        "state": 0
    };
    n.propstyle = {
        "font-size": 12,
        "fill": "#999"
    };
    n.proprow = 2;
    n.propmargin = 3;
    n.propview = [];
    n.path = "M" + (n.img.width + n.propmargin) + "," + n.img.height + "L" + (n.img.width + n.propmargin) + ",0L" + (-n.propmargin) + ",0L" + (-n.propmargin) + "," + n.img.height;
    n.zpath = "Z";
    n.sy = (n.img.height + n.propn * (n.propstyle["font-size"] + n.proprow)) / 2;
    n.ag = [{
        a: getAngle(n.img.width / 2, 0, n.img.width / 2, n.sy),
        c: [n.img.width / 2, 0]
    }, {
        a: getAngle((-n.propmargin), 0, n.img.width / 2, n.sy),
        c: [(-n.propmargin), 0]
    }];
    if (n.img.height <= n.sy) {
        n.ag.push({
            a: getAngle((-n.propmargin), n.img.height, n.img.width / 2, n.sy),
            c: [(-n.propmargin), n.img.height]
        })
    };
    $.each(n.prop, function(i, d) {
        if (i < n.propn) {
            var temp = {};
            d.type == 0 ? temp.value = d.value : temp.value = d.title + ":" + d.value;
            temp.width = temp.value.getBLen() * (n.propstyle["font-size"] / 2);
            temp.x = n.img.width / 2;
            if (temp.width < n.img.width) temp.width = n.img.width;
            temp.px = -(temp.width - n.img.width) / 2 - n.propmargin;
            temp.y = n.img.height + i * (n.propstyle["font-size"] + n.proprow);
            temp.ty = temp.y + n.propstyle["font-size"];
            n.propview.push(temp);
            n.path += "L" + temp.px + "," + temp.y + "L" + temp.px + "," + (temp.y + n.propstyle["font-size"] + n.proprow);
            n.zpath = "L" + (temp.px + temp.width + n.propmargin * 2) + "," + (temp.y + n.propstyle["font-size"] + n.proprow) + "L" + (temp.px + temp.width + n.propmargin * 2) + "," + temp.y + n.zpath;
            n.ag.push({
                a: getAngle(temp.px, temp.y, n.img.width / 2, n.sy),
                c: [temp.px, temp.y]
            });
            if ((temp.y + n.propstyle["font-size"] + n.proprow) <= n.sy) {
                n.ag.push({
                    a: getAngle(temp.px, (temp.y + n.propstyle["font-size"] + n.proprow), n.img.width / 2, n.sy),
                    c: [temp.px, (temp.y + n.propstyle["font-size"] + n.proprow)]
                })
            };
            if (i == (n.propn - 1)) {
                n.ag.push({
                    a: getAngle(temp.px, (temp.y + n.propstyle["font-size"] + n.proprow), n.img.width / 2, n.sy),
                    c: [temp.px, (temp.y + n.propstyle["font-size"] + n.proprow)]
                });
                n.ag.push({
                    a: getAngle(n.img.width / 2, n.sy * 2, n.img.width / 2, n.sy),
                    c: [n.img.width / 2, n.sy * 2]
                })
            }
        }
    });
    n.path = n.path + n.zpath;
    n.rad = gs(n.ag, [n.img.width / 2, n.sy]);
    return n
};

function fixLink(l) {
    l.propstyle = {
        "font-size": 12,
        "fill": "#999"
    };
    l.propview = [];
    l.path = "";
    l.linkpos = 0;
    l.sy = 0;
    l.source = nodemap.get(l.source);
    l.target = nodemap.get(l.target);
    l.linkstr = [l.source.id + "_$$_" + l.target.id, l.target.id + "_$$_" + l.source.id];
    l.path = "";
    l.zpath = "Z";
    $.each(l.prop, function(i, d) {
        if (i >= l.propn) {
            return
        }
        var temp = {};
        d.type == 0 ? temp.value = d.value : temp.value = d.title + ":" + d.value;
        temp.width = temp.value.getBLen() * (l.propstyle["font-size"] / 2);
        temp.x = -temp.width / 2;
        temp.y = i * (l.propstyle["font-size"] + l.proprow) - (l.propstyle["font-size"] + l.proprow) * l.propn / 2;
        temp.ty = temp.y + l.propstyle["font-size"];
        l.propview.push(temp);
        l.path += (i == 0 ? "M" : "L") + temp.x + "," + temp.y + "L" + temp.x + "," + (temp.y + l.propstyle["font-size"] + l.proprow);
        l.zpath = "L" + (temp.x + temp.width) + "," + (temp.y + l.propstyle["font-size"] + l.proprow) + "L" + (temp.x + temp.width) + "," + temp.y + l.zpath
    });
    l.path = l.path + l.zpath;
    return l
};
function gs(tag, cc) {
    var cd = 'function(x){}';
    var mcd = '';
    return function(x) {
        var rx = [];
        for (var i = 0; i < tag.length - 1; i++) {
            if (x <= tag[i].a && x >= tag[i + 1].a) {
                rx[0] = getArrowDis.apply(window, ((tag[i].c[1] == tag[i + 1].c[1]) ? [x, cc[1], tag[i].c[1], true] : [x, cc[0], tag[i].c[0], false]))
            }
            if (-x <= tag[i].a && -x >= tag[i + 1].a) {
                rx[1] = getArrowDis.apply(window, ((tag[i].c[1] == tag[i + 1].c[1]) ? [-x, cc[1], tag[i].c[1], true] : [-x, cc[0], tag[i].c[0], false]))
            }
        }
        return rx
    }
}