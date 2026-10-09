import java.io.*;
import java.util.*;
import flex.messaging.io.amf.ASObject;
import flex.messaging.io.amf.Amf3Input;
import flex.messaging.io.SerializationContext;

public class DumpXunbao {
    public static void main(String[] args) {
        try {
            File f = new File("config/game/sys_config/xunbaojiage.jat");
            FileInputStream fis = new FileInputStream(f);
            SerializationContext context = new SerializationContext();
            Amf3Input input = new Amf3Input(context);
            input.setInputStream(new BufferedInputStream(fis));
            Object obj = input.readObject();
            System.out.println("Obj: " + obj.getClass().getName());
            if (obj instanceof Object[]) {
                Object[] arr = (Object[]) obj;
                for (Object item : arr) {
                    System.out.println(item);
                }
            } else if (obj instanceof Map) {
                Map m = (Map) obj;
                for (Object k : m.keySet()) {
                    System.out.println(k + " => " + m.get(k));
                }
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
