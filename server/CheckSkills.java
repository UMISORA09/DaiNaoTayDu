import java.io.*;
import java.util.*;
import flex.messaging.io.*;
import flex.messaging.io.amf.*;

public class CheckSkills {
    public static void main(String[] args) throws Exception {
        FileInputStream fis = new FileInputStream("config/game/sys_config/JiNengBiao.jat");
        Amf3Input input = new Amf3Input(new SerializationContext());
        input.setInputStream(fis);
        Object obj = input.readObject();
        fis.close();
        if (obj instanceof Object[]) {
            for (Object item : (Object[]) obj) {
                if (item instanceof Map) {
                    Map map = (Map) item;
                    String skillid = String.valueOf(map.get("skillid"));
                    if (skillid.contains("shebishi") || skillid.contains("sj0215")) {
                        System.out.println("ID: " + skillid + " | type: " + map.get("skilltype") + " | lvl: " + map.get("level") + " | lian: " + map.get("lianskill") + " | targettype: " + map.get("targettype"));
                    }
                }
            }
        }
    }
}
