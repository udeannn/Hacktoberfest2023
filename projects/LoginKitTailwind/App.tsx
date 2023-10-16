/**
 * Sample React Native App
 * https://github.com/facebook/react-native
 *
 * @format
 */

import React, {useState} from 'react';
import {
  Button,
  Image,
  SafeAreaView,
  Text,
  TextInput,
  ToastAndroid,
  TouchableOpacity,
  View,
} from 'react-native';

function App(): JSX.Element {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [showPassword, setShowPassword] = useState(false);

  const onPressForgotPassword = () => {
    ToastAndroid.show('Forgot Password', ToastAndroid.SHORT);
  };

  const handleLogin = () => {
    ToastAndroid.show('Login', ToastAndroid.SHORT);
  };

  return (
    <SafeAreaView className={'bg-white flex-1 p-6 gap-y-1'}>
      <View className="">
        <View className="gap-1 py-4">
          <Text className="text-[26px] font-semibold text-black">
            Sign in to
          </Text>
          <Text className="text-[12px] text-black font-medium">
            Login UI Kit Using Tailwinds
          </Text>
        </View>
        <View>
          <Text className="text-[14px]">
            If you don’t have an account register
          </Text>
          <Text>
            <Text>You can </Text>
            <Text className="text-purple-500 font-semibold">
              Register here !
            </Text>
          </Text>
        </View>
      </View>

      <View
        className="gap-y-8 pt-2"
        style={{
          justifyContent: 'flex-start',
        }}>
        <TextInput
          className="border-[1px] border-purple-500 w-['100%] rounded-lg bg-purple-50 px-3"
          placeholder="Enter email or user name"
          keyboardType="email-address"
          value={email}
          onChangeText={text => setEmail(text)}
        />
        <View>
          <TextInput
            className="border-[1px] border-purple-500 w-['100%] rounded-lg bg-purple-50 px-3"
            placeholder="Password"
            keyboardType="default"
            secureTextEntry={!showPassword}
            onChangeText={text => setPassword(text)}
            value={password}
          />
          <TouchableOpacity
            className="absolute right-4 top-[15px]"
            onPress={() => {
              setShowPassword(prev => !prev);
            }}>
            <Image
              source={
                !showPassword
                  ? require('./src/icons/eye.png')
                  : require('./src/icons/eye-cancel.png')
              }
              className=" h-[24px] w-[24px] "
            />
          </TouchableOpacity>
          <TouchableOpacity onPress={onPressForgotPassword}>
            <Text className="text-right pt-1 text-gray-400 text-[13px]">
              Forgot Password?
            </Text>
          </TouchableOpacity>
        </View>

        <TouchableOpacity
          className="w-fit bg-violet-700 rounded-lg py-4 items-center h-[60px] justify-center"
          style={{}}
          onPress={handleLogin}>
          <Text className="font-medium text-white text-[16px]">Login</Text>
        </TouchableOpacity>
      </View>

      <View className="justify-center items-center gap-y-4  ">
        <Text className="text-gray-400 text-[16px] font-semibold">
          or continue with
        </Text>
        <View className="flex-row gap-x-4">
          <TouchableOpacity>
            <Image
              source={require('./src/icons/apple.png')}
              className="h-[40px] w-[40px]"
            />
          </TouchableOpacity>
          <TouchableOpacity>
            <Image
              source={require('./src/icons/google.png')}
              className="h-[40px] w-[40px]"
            />
          </TouchableOpacity>
          <TouchableOpacity>
            <Image
              source={require('./src/icons/facebook.png')}
              className="h-[40px] w-[40px]"
            />
          </TouchableOpacity>
        </View>
      </View>
    </SafeAreaView>
  );
}

export default App;
