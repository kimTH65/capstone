package com.tarks.ocrtest4;

public class TradeViewItem {

    private  String name;
    private  String nikname;
    private  String job;


    public TradeViewItem(String name, String nikname, String job) {
        setName(name);
        setNikname(nikname);
        setJob(job);
    }


    public void setName(String name) {

        this.name = name;

    }
    public void setNikname(String nikname) {

        this.nikname = nikname;

    }
    public void setJob(String job) {

        this.job = job;

    }

    public String getName() {
        return this.name;
    }
    public String getNikname() {
        return this.nikname;
    }
    public String getJob() {
        return this.job;
    }

}
